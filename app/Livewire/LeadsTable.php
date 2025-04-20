<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Partner;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;

class LeadsTable extends Component
{
    use WithPagination, WithFileUploads;

    public $showEditModal = false;
    public $editingLeadId = null;
    public $full_name;
    public $quantity;
    public $type;
    public $status;
    public $countLeads;
    public $leadSourceId;
    public $partnerId;
    public $importFile;
    public $showImportModal = false;
    
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

    public function import()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);
        
        try {
            Excel::import(new LeadsImport, $this->importFile->getRealPath());
            
            $this->reset('importFile');
            $this->showImportModal = false;
            $this->getCountLeads();
            
            session()->flash('message', 'Заявки успешно импортированы!');
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при импорте: ' . $e->getMessage());
        }
    }

    public function export($format = 'xlsx')
    {
        $fileName = 'leads_' . date('Y-m-d') . '.' . $format;
        
        if ($format === 'csv') {
            return Excel::download(new LeadsExport, $fileName, \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        }
        
        return Excel::download(new LeadsExport, $fileName);
    }

    private function getStatusText($status)
    {
        $statuses = [
            'pending' => 'В ожидании',
            'in_progress' => 'В работе',
            'sold_to_partner' => 'Продана партнеру',
            'cancelled' => 'Отменена',
        ];
        
        return $statuses[$status] ?? $status;
    }

    public function showImportModal()
    {
        $this->showImportModal = true;
        $this->resetErrorBag();
        $this->importFile = null;
    }

    public function closeImportModal()
    {
        $this->showImportModal = false;
    }
}