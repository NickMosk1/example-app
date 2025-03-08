<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $perPage = 25;

    public function render()
    {
        $users = User::paginate($this->perPage);
        return view('customPages.usersTablePage.users-table-page', [
            'users' => $users,
        ])->layout('components.layouts.customLayout.custom-layout');
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->name = '';
        $this->email = '';
        $this->password = '';

        session()->flash('success', 'Пользователь успешно создан.');
    }
}
