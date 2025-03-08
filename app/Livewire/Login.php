<?php

namespace App\Http\Livewire;

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
            return redirect()->route('users.table');
        } else {
            session()->flash('error', 'Неверные учетные данные.');
        }
    }

    public function render()
    {
        return view('customPages.loginPage.login-page');
    }
}
