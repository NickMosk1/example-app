<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $title = 'Главная';

    public function render()
    {
        return view('customPages.homePage.home-page')
            ->layout('components.layouts.customLayout.custom-layout')
            ->with('title', $this->title);
    }
}