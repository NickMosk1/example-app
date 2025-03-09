<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;

class CreateLead extends Component
{
    public $full_name;
    public $quantity;
    public $type;
    public $status;

    public function create()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        Lead::create([
            'full_name' => $this->full_name,
            'quantity' => $this->quantity,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Заявка успешно создана.');

        return redirect()->route('leads.table');
    }

    public function render()
    {
        return view('customPages.createLeadPage.create-lead-page')->layout('components.layouts.customLayout.custom-layout');
    }
}
