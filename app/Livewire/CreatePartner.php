<?php

namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;

class CreatePartner extends Component
{
    public $name;
    public $email;
    public $phone;

    public function render()
    {
        return view('customPages.createPartnerPage.create-partner-page');
    }

    public function createPartner()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:partners',
            'phone' => 'required|string|max:20',
        ]);

        Partner::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->reset(['name', 'email', 'phone']);

        session()->flash('success', 'Партнер успешно создан.');
    }
}