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
    
    public $sourceFilter = '';
    public $partnerFilter = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    
    public $leadSources;
    public $partners;

    public function mount()
    {
        $this->leadSources = LeadSource::all();
        $this->partners = Partner::all();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->reset(['sourceFilter', 'partnerFilter', 'statusFilter', 'sortField', 'sortDirection']);
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
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

        $updateData = [
            'quantity' => $this->quantity,
            'type' => $this->type,
            'status' => $this->status,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'lead_source_id' => $this->leadSourceId ?: null,
            'partner_id' => $this->partnerId ?: null,
        ];

        $lead->update($updateData);

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

    public function nextPage()
    {
        $this->setPage($this->page + 1);
    }
    
    public function previousPage()
    {
        $this->setPage($this->page - 1);
    }
    
    public function gotoPage($page)
    {
        $this->setPage($page);
    }

    public function render()
    {
        $query = Lead::with(['leadSource', 'partner'])
            ->when($this->sourceFilter, function ($query) {
                $query->where('lead_source_id', $this->sourceFilter);
            })
            ->when($this->partnerFilter, function ($query) {
                $query->where('partner_id', $this->partnerFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection);
            
        $leads = $query->paginate($this->perPage);
        
        return view('customPages.leadsTablePage.leads-table-page', [
            'leads' => $leads,
        ]);
    }

    public function getCountLeads()
    {
        $this->countLeads = Lead::count();
    }

    public function import()
    {
        $this->validate(['importFile' => 'required|file|mimes:xlsx,xls,csv|max:10240']);

        try {
            $import = new LeadsImport();
            Excel::import($import, $this->importFile);

            $importedCount = $import->getRowCount();
            $failures = $import->getFailures();

            if (!empty($failures)) {
                $errorMessages = [];
                foreach ($failures as $failure) {
                    $errorMessages[] = "Строка {$failure['row']}: " . implode(', ', $failure['errors']);
                }
                
                $this->dispatch('notify', 
                    type: 'warning',
                    message: 'Импорт завершен с ошибками:<br>' . implode('<br>', $errorMessages)
                );
            } else {
                $this->dispatch('notify',
                    type: 'success',
                    message: "Успешно импортировано {$importedCount} записей"
                );
            }

            $this->reset(['importFile', 'showImportModal']);
            $this->emit('refreshLeadsTable');

        } catch (\Exception $e) {
            $this->dispatch('notify',
                type: 'error',
                message: 'Ошибка импорта: ' . $e->getMessage()
            );
        }
    }

    public function export($format = 'xlsx')
    {
        $fileName = 'leads_' . date('Y-m-d') . '.' . $format;
        
        $filters = [
            'partner_id' => $this->partnerFilter,
            'lead_source_id' => $this->sourceFilter,
            'status' => $this->statusFilter,
            'sort_field' => $this->sortField,
            'sort_direction' => $this->sortDirection,
        ];
        
        if ($format === 'csv') {
            return Excel::download(new LeadsExport($filters), $fileName, \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        }
        
        return Excel::download(new LeadsExport($filters), $fileName);
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

    protected $listeners = ['showFlashMessage' => 'showFlash'];

    public function showFlash($type, $message)
    {
        session()->flash($type, $message);
    }
}