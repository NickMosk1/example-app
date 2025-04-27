<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Partner;
use Livewire\WithPagination;

class PartnersTable extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $editingPartnerId = null;
    public $name;
    public $email;
    public $phone;
    public $perPage = 25;

    public function edit($partnerId)
    {
        $partner = Partner::findOrFail($partnerId);
        
        $this->editingPartnerId = $partnerId;
        $this->name = $partner->name;
        $this->email = $partner->email;
        $this->phone = $partner->phone;
        
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:partners,email,'.$this->editingPartnerId,
            'phone' => 'required',
        ]);

        Partner::find($this->editingPartnerId)->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->showEditModal = false;
        session()->flash('message', 'Партнер успешно обновлен');
    }
    
    public function confirmDelete($partnerId)
    {
        $partner = Partner::find($partnerId);

        if ($partner) {
            $partner->delete();
            session()->flash('message', 'Партнер успешно удален');
        } else {
            session()->flash('error', 'Партнер не найден');
        }
    }

    public function closeModal()
    {
        $this->showEditModal = false;
        $this->editingPartnerId = null;
        $this->reset(['name', 'email', 'phone']);
        $this->resetValidation();
    }

    public function render()
    {
        $partners = Partner::withCount('leads')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        
        return view('customPages.partnersTablePage.partners-table-page', [
            'partners' => $partners,
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}