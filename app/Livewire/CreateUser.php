<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $selectedRoles = []; // Массив для хранения выбранных ролей

    public function render()
    {
        return view('customPages.createUserFormPage.create-user-form-page', [
            'roles' => Role::all() // Получаем все доступные роли
        ]);
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'selectedRoles' => 'required|array|min:1',
            'selectedRoles.*' => 'exists:roles,name'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Назначаем выбранные роли
        $user->syncRoles($this->selectedRoles);

        $this->reset(['name', 'email', 'password', 'selectedRoles']);

        session()->flash('success', 'Пользователь успешно создан с выбранными ролями.');
    }
}