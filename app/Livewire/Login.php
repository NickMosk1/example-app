<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('admin.panel');
        } else {
            session()->flash('error', 'Такого аккаунта не существует! Пожалуйста, повторите попытку авторизации.');
        }
    }

    public function render()
    {
        return view('customPages.loginPage.login-page');
    }
}
