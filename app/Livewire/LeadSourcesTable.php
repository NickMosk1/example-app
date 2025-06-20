<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LeadSource;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class LeadSourcesTable extends Component
{
    use WithPagination;

    public bool $showEditModal = false;
    public bool $showStatsModal = false;
    public ?LeadSource $currentSource = null;
    public ?int $editingSourceId = null;
    public array $stats = [];
    public array $form = [
        'name' => '',
        'is_native' => false,
        'email' => '',
        'phone' => '',
        'min_purchase_price' => 0,
        'max_purchase_price' => 0,
        'min_sale_price' => 0,
        'max_sale_price' => 0,
    ];
    protected $listeners = ['closeStatsModal'];

    public function edit(int $sourceId): void
    {
        $source = LeadSource::findOrFail($sourceId);
        
        $this->editingSourceId = $sourceId;
        $this->form = [
            'name' => $source->name,
            'is_native' => $source->is_native,
            'email' => $source->email,
            'phone' => $source->phone,
            'min_purchase_price' => $source->min_purchase_price,
            'max_purchase_price' => $source->max_purchase_price,
            'min_sale_price' => $source->min_sale_price,
            'max_sale_price' => $source->max_sale_price,
        ];
        
        $this->showEditModal = true;
    }

    public function update(): void
    {
        $this->validate([
            'form.name' => 'required|min:3|unique:lead_sources,name,'.$this->editingSourceId,
            'form.is_native' => 'boolean',
            'form.email' => 'nullable|email',
            'form.phone' => 'nullable',
            'form.min_purchase_price' => 'numeric|min:0',
            'form.max_purchase_price' => 'numeric|min:0|gte:form.min_purchase_price',
            'form.min_sale_price' => 'numeric|min:0',
            'form.max_sale_price' => 'numeric|min:0|gte:form.min_sale_price',
        ]);

        LeadSource::find($this->editingSourceId)->update([
            'name' => $this->form['name'],
            'is_native' => $this->form['is_native'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'min_purchase_price' => $this->form['min_purchase_price'],
            'max_purchase_price' => $this->form['max_purchase_price'],
            'min_sale_price' => $this->form['min_sale_price'],
            'max_sale_price' => $this->form['max_sale_price'],
        ]);

        $this->showEditModal = false;
        session()->flash('message', 'Источник успешно обновлен');
    }
    
    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingSourceId = null;
        $this->reset('form');
        $this->resetValidation();
    }

    public function showSourceStats(int $sourceId): void
    {
        $this->currentSource = LeadSource::with(['leads'])->findOrFail($sourceId);
        $this->prepareStats();
        $this->showStatsModal = true;
    }

    protected function prepareStats(): void
    {
        $leads = $this->currentSource->leads;
        $soldLeads = $leads->where('status', 'sold_to_partner');
        
        $totalLeads = $leads->count();
        $soldCount = $soldLeads->count();
        
        $this->stats = [
            'total_leads' => $totalLeads,
            'sold_leads' => $soldCount,
            'in_progress' => $leads->where('status', 'in_progress')->count(),
            'pending' => $leads->where('status', 'pending')->count(),
            'cancelled' => $leads->where('status', 'cancelled')->count(),
            'conversion_rate' => $totalLeads > 0 ? round(($soldCount / $totalLeads) * 100, 2) : 0,
            
            'avg_purchase_price' => $leads->avg('purchase_price') ?? 0,
            'avg_sale_price' => $leads->avg('sale_price') ?? 0,
            'avg_profit' => $soldCount > 0 ? $soldLeads->avg(fn($lead) => $lead->sale_price - $lead->purchase_price) : 0,
            'total_purchase' => $leads->sum('purchase_price'),
            'potential_income' => $leads->sum('sale_price'),
            'actual_income' => $soldLeads->sum('sale_price'),
            'profit' => $soldLeads->sum(fn($lead) => $lead->sale_price - $lead->purchase_price),
            
            'top_profitable' => $this->getTopProfitableLeads($leads),
            'leads_by_date' => $leads->sortByDesc('created_at')->take(10),
        ];
    }

    protected function getTopProfitableLeads(Collection $leads): Collection
    {
        return $leads->whereNotNull('sale_price')
            ->sortByDesc(fn($lead) => $lead->sale_price - $lead->purchase_price)
            ->take(5);
    }

    public function closeStatsModal(): void
    {
        $this->showStatsModal = false;
        $this->reset(['currentSource', 'stats']);
    }

    public function getStatusLabel(string $status): string
    {
        return match($status) {
            'pending' => 'В ожидании',
            'in_progress' => 'В работе',
            'sold_to_partner' => 'Продано партнеру',
            'cancelled' => 'Отменено',
            default => $status
        };
    }

    public function render()
    {
        return view('customPages.leadSourcesTablePage.lead-sources-table-page', [
            'sources' => LeadSource::paginate(15)
        ]);
    }
}