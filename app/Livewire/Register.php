<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('customPages.registerPage.register-page');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('applicant');

        $this->reset(['name', 'email', 'password', 'password_confirmation']);

        session()->flash('success', 'Регистрация прошла успешно! Теперь вы можете войти в систему.');
        
        return redirect()->route('login');
    }
}