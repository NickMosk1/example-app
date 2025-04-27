<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Partner;
use App\Models\Lead;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class PartnersTable extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $showStatsModal = false;
    public $editingPartnerId = null;
    public $currentPartner = null;
    public $stats = [];
    public $name;
    public $email;
    public $phone;
    public $perPage = 25;

    protected $listeners = ['closeStatsModal'];

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

    public function showPartnerStats(int $partnerId): void
    {
        $this->currentPartner = Partner::with(['leads'])->findOrFail($partnerId);
        $this->prepareStats();
        $this->showStatsModal = true;
    }

    protected function prepareStats(): void
    {
        $leads = $this->currentPartner->leads;
        $completedLeads = $leads->where('status', 'sold_to_partner');
        
        $totalLeads = $leads->count();
        $completedCount = $completedLeads->count();
        
        $this->stats = [
            // Основная статистика
            'total_leads' => $totalLeads,
            'completed_deals' => $completedCount,
            'in_progress' => $leads->where('status', 'in_progress')->count(),
            'cancelled' => $leads->where('status', 'cancelled')->count(),
            'conversion_rate' => $totalLeads > 0 ? round(($completedCount / $totalLeads) * 100, 2) : 0,
            
            // Финансовая статистика
            'avg_deal_amount' => $completedLeads->avg('sale_price') ?? 0,
            'total_turnover' => $completedLeads->sum('sale_price'),
            'avg_profit' => $completedCount > 0 ? $completedLeads->avg(fn($lead) => $lead->sale_price - $lead->purchase_price) : 0,
            'total_profit' => $completedLeads->sum(fn($lead) => $lead->sale_price - $lead->purchase_price),
            
            // Топ и последние сделки
            'top_deals' => $this->getTopDeals($completedLeads),
            'recent_deals' => $leads->sortByDesc('created_at')->take(10),
            
            // Данные для графиков
            'chartData' => $this->prepareChartData($leads, $completedLeads)
        ];

        $this->dispatch('updatePartnerCharts', $this->stats['chartData']);
    }

    protected function prepareChartData(Collection $leads, Collection $completedLeads): array
    {
        return [
            'statusLabels' => ['В ожидании', 'В работе', 'Завершено', 'Отменено'],
            'statusValues' => [
                $leads->where('status', 'pending')->count(),
                $leads->where('status', 'in_progress')->count(),
                $completedLeads->count(),
                $leads->where('status', 'cancelled')->count()
            ],
            'financeLabels' => $this->getMonthlyLabels($leads),
            'financeValues' => $this->getMonthlyDealsData($leads),
            'colors' => [
                'status' => ['#FFC107', '#2196F3', '#4CAF50', '#F44336'],
                'finance' => ['#2196F3']
            ]
        ];
    }

    protected function getMonthlyLabels(Collection $leads): array
    {
        if ($leads->isEmpty()) {
            return ['Нет данных'];
        }

        $months = $leads->groupBy(fn($lead) => $lead->created_at->format('Y-m'))
            ->keys()
            ->sort()
            ->map(fn($month) => \Carbon\Carbon::createFromFormat('Y-m', $month)->format('M Y'))
            ->toArray();

        return $months ?: ['Нет данных'];
    }

    protected function getMonthlyDealsData(Collection $leads): array
    {
        if ($leads->isEmpty()) {
            return [0];
        }

        return $leads->groupBy(fn($lead) => $lead->created_at->format('Y-m'))
            ->sortBy(function($group, $key) {
                return $key;
            })
            ->map(fn($group) => $group->sum('sale_price'))
            ->values()
            ->toArray();
    }

    protected function getTopDeals(Collection $leads): Collection
    {
        return $leads->sortByDesc('sale_price')
            ->take(5);
    }

    public function closeStatsModal(): void
    {
        $this->showStatsModal = false;
        $this->reset(['currentPartner', 'stats']);
    }

    public function getStatusLabel(string $status): string
    {
        return match($status) {
            'pending' => 'В ожидании',
            'in_progress' => 'В работе',
            'sold_to_partner' => 'Завершено',
            'cancelled' => 'Отменено',
            default => $status
        };
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