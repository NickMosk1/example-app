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
use Illuminate\Support\Facades\Auth;

class LeadsTableByPartnerId extends Component
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
    public $title;

    public function mount()
    {
        $this->leadSources = LeadSource::all();
        $this->partners = Partner::all();
        $this->title = 'Заявки, переданные мне';
    }

    public function render()
    {
        $user = Auth::user();
        $partner = $user->partners()->first();
        
        if (!$partner) {
            return view('customPages.leadsTableByPartnerIdPage.leads-table-by-partner-id-page', [
                'leads' => collect([])->paginate(20)
            ]);
        }

        $leads = Lead::with(['leadSource', 'partner'])
            ->where('partner_id', $partner->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('customPages.leadsTableByPartnerIdPage.leads-table-by-partner-id-page', [
            'leads' => $leads
        ]);
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

        $this->showEditModal = false;
        session()->flash('modal_success', 'Заявка успешно обновлена');
    }

    public function rejectLead($leadId)
    {
        $lead = Lead::findOrFail($leadId);
        $lead->update(['partner_id' => null]);
        
        session()->flash('message', 'Вы отказались от заявки #'.$leadId);
    }

    public function getCountLeads()
    {
        $user = Auth::user();
        $this->countLeads = Lead::where('partner_id', $user->partner->id)->count();
    }

    public function export($format = 'xlsx')
    {
        $filters = [];
        
        $partner = Auth::user()->partners()->first();
        if ($partner) {
            $filters['partner_id'] = $partner->id;
        }

        $fileName = 'leads_export_' . date('Y-m-d') . '.' . $format;
        $export = new LeadsExport($filters);

        if ($format === 'csv') {
            return Excel::download($export, $fileName, \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        }
        
        return Excel::download($export, $fileName);
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
}