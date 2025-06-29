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
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadAssignedNotification;
use Illuminate\Support\Facades\Log;

class LeadsTable extends Component
{
    use WithPagination, WithFileUploads;

    public $showEditModal = false;
    public $editingLeadId = null;
    public $quantity;
    public $type;
    public $status;
    public $countLeads;
    public $leadSourceId;
    public $partnerId;
    public $purchase_price;
    public $sale_price;
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
        $lead = Lead::with(['leadSource', 'partner'])->findOrFail($leadId);
        
        $this->editingLeadId = $leadId;
        $this->quantity = $lead->quantity;
        $this->type = $lead->type;
        $this->status = $lead->status;
        $this->purchase_price = $lead->purchase_price;
        $this->sale_price = $lead->sale_price;
        $this->leadSourceId = $lead->lead_source_id;
        $this->partnerId = $lead->partner_id;
        
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'quantity' => 'required|integer|min:1',
            'type' => 'required|min:5',
            'status' => 'required|in:pending,in_progress,sold_to_partner,cancelled',
            'purchase_price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'leadSourceId' => 'nullable|exists:lead_sources,id',
            'partnerId' => 'nullable|exists:partners,id',
        ]);

        $lead = Lead::findOrFail($this->editingLeadId);
        
        $oldPartnerId = $lead->partner_id;
        
        if ($lead->lead_source_id !== $this->leadSourceId) {
            if ($lead->lead_source_id) {
                $lead->leadSource()->decrement('total_leads');
            }
            if ($this->leadSourceId) {
                LeadSource::find($this->leadSourceId)->increment('total_leads');
            }
        }

        $lead->update([
            'quantity' => $this->quantity,
            'type' => $this->type,
            'status' => $this->status,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'lead_source_id' => $this->leadSourceId,
            'partner_id' => $this->partnerId,
        ]);

        if ($oldPartnerId != $this->partnerId && $this->partnerId) {
            try {
                $partner = Partner::findOrFail($this->partnerId);
                Mail::to($partner->email)
                    ->send(new LeadAssignedNotification($lead));
                    
                session()->flash('success', 'Письмо партнеру успешно отправлено');
            } catch (\Exception $e) {
                Log::error('Ошибка отправки письма партнеру', [
                    'partner_id' => $this->partnerId,
                    'error' => $e->getMessage()
                ]);
                session()->flash('warning', 'Письмо не отправлено: ' . $e->getMessage());
            }
        }

        $this->showEditModal = false;
        session()->flash('success', 'Заявка успешно обновлена');
    }

    public function confirmDelete($leadId)
    {
        $lead = Lead::find($leadId);

        if ($lead) {
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
        $this->reset([
            'quantity', 'type', 'status', 
            'purchase_price', 'sale_price',
            'leadSourceId', 'partnerId'
        ]);
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