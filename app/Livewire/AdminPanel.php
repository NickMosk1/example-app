<?php

namespace App\Livewire;

use Livewire\Component;

class AdminPanel extends Component
{
    public function render()
    {
        return view('customPages.adminPanelPage.admin-panel-page')->layout('components.layouts.customLayout.custom-layout');
    }
}