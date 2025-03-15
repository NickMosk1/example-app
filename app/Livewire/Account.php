<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Account extends Component
{
    // Логика компонента (если нужна)
    
    public function render()
    {
        return view('customPages.accountPage.account-page')
            ->layout('components.layouts.customLayout.custom-layout', [
                // Передача данных в layout (если требуется)
                'colors' => config('app.colors'), // Пример передачи цветов
                'title' => 'Личный кабинет'
            ]);
    }
}