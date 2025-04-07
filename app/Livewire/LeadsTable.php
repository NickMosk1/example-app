<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Partner;
use Livewire\WithPagination;

class LeadsTable extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $editingLeadId = null;
    public $full_name;
    public $quantity;
    public $type;
    public $status;
    public $countLeads;
    public $leadSourceId;
    public $partnerId;
    
    public $leadSources;
    public $partners;

    public function mount()
    {
        $this->leadSources = LeadSource::all();
        $this->partners = Partner::all();
    }

    public function edit($leadId)
    {
        $lead = Lead::findOrFail($leadId);
        
        $this->editingLeadId = $leadId;
        $this->full_name = $lead->full_name;
        $this->quantity = $lead->quantity;
        $this->type = $lead->type;
        $this->status = $lead->status;
        $this->leadSourceId = $lead->lead_source_id;
        $this->partnerId = $lead->partner_id;
        
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'full_name' => 'required|min:3',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|min:5',
            'status' => 'required|in:pending,in_progress,sold_to_partner,cancelled',
            'leadSourceId' => 'nullable|exists:lead_sources,id',
            'partnerId' => 'nullable|exists:partners,id',
        ]);

        Lead::find($this->editingLeadId)->update([
            'full_name' => $this->full_name,
            'quantity' => $this->quantity,
            'type' => $this->type,
            'status' => $this->status,
            'lead_source_id' => $this->leadSourceId,
            'partner_id' => $this->partnerId,
        ]);

        $this->showEditModal = false;
        session()->flash('message', 'Заявка успешно обновлена');
    }

    public function confirmDelete($leadId)
    {
        $lead = Lead::find($leadId);

        if ($lead) {
            // Уменьшаем счетчик заявок у источника
            if ($lead->lead_source_id) {
                $lead->leadSource()->decrement('total_leads');
            }
            
            $lead->delete();
            session()->flash('message', 'Заявка успешно удалена');
        } else {
            session()->flash('error', 'Заявка не найдена');
        }
    }

    public function closeModal()
    {
        $this->showEditModal = false;
        $this->editingLeadId = null;
        $this->reset(['full_name', 'quantity', 'type', 'status', 'leadSourceId', 'partnerId']);
        $this->resetValidation();
    }

    public function render()
    {
        $leads = Lead::with(['leadSource', 'partner'])->paginate(20);
        
        return view('customPages.leadsTablePage.leads-table-page', [
            'leads' => $leads,
        ])->layout('components.layouts.customLayout.custom-layout');
    }


    public function getCountLeads()
    {
        $this->countLeads = Lead::count();
    }
}