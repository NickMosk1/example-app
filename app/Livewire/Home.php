<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $title = 'Главная';
    public $isAuthenticated;

    public function mount()
    {
        $this->isAuthenticated = Auth::check();
    }

    public function logout()
    {
        Auth::logout();

        $this->isAuthenticated = false;

        return redirect()->to('/');
    }

    public function render()
    {
        return view('customPages.homePage.home-page', [
            'title' => $this->title,
            'isAuthenticated' => $this->isAuthenticated,
        ]);
    }
}
