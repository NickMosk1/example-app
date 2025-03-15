<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;

    public function render()
    {
        return view('customPages.createUserFormPage.create-user-form-page')->layout('components.layouts.customLayout.custom-layout');
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1',
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