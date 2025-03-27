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
        // Проверяем, авторизован ли пользователь
        $this->isAuthenticated = Auth::check();
    }

    public function logout()
    {
        // Удаляем пользователя из сессии
        Auth::logout();

        // Обновляем статус авторизации
        $this->isAuthenticated = false;

        // Перезагружаем страницу
        return redirect()->to('/');
    }

    public function render()
    {
        return view('customPages.homePage.home-page', [
            'title' => $this->title,
            'isAuthenticated' => $this->isAuthenticated,
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}
