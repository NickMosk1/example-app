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
    public $perPage = 25; // Количество записей на странице по умолчанию

    public function render()
    {
        $users = User::paginate($this->perPage);
        return view('livewire.users', [
            'users' => $users,
        ])->layout('layouts.app');
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

        // Сброс полей формы после создания
        $this->name = '';
        $this->email = '';
        $this->password = '';

        session()->flash('success', 'Пользователь успешно создан.');
    }
}
