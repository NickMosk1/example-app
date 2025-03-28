<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $editingUserId = null;
    public $name;
    public $email;
    public $selectedRoles = [];
    public $allRoles;
    public $perPage = 25;

    public function mount()
    {
        $this->allRoles = Role::all();
    }

    public function edit($userId)
    {
        $user = User::with('roles')->findOrFail($userId);
        
        $this->editingUserId = $userId;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->getRoleNames()->toArray();
        
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$this->editingUserId,
            'selectedRoles' => 'required|array|min:1',
        ]);

        $user = User::find($this->editingUserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Исправлено: передаем имена ролей вместо ID
        $user->syncRoles($this->selectedRoles);

        $this->showEditModal = false;
        session()->flash('message', 'Пользователь успешно обновлен');
    }
    
    // Метод для удаления пользователя
    public function confirmDelete($userId)
    {
        $user = User::find($userId);

        if ($user) {
            // Удаляем все роли пользователя перед удалением
            $user->roles()->detach();
            $user->delete();
            
            session()->flash('message', 'Пользователь успешно удален');
        } else {
            session()->flash('error', 'Пользователь не найден');
        }
    }

    // Метод для закрытия модального окна
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->editingUserId = null;
        $this->reset(['name', 'email', 'selectedRoles']);
        $this->resetValidation();
    }

    public function render()
    {
        $users = User::with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        
        return view('customPages.usersTablePage.users-table-page', [
            'users' => $users,
            'allRoles' => $this->allRoles,
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}