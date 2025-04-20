<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LeadSource;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class LeadSourcesTable extends Component
{
    use WithPagination;

    public bool $showStatsModal = false;
    public ?LeadSource $currentSource = null;
    public array $stats = [];
    protected $listeners = ['closeStatsModal'];

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
            // Основная статистика
            'total_leads' => $totalLeads,
            'sold_leads' => $soldCount,
            'in_progress' => $leads->where('status', 'in_progress')->count(),
            'pending' => $leads->where('status', 'pending')->count(),
            'cancelled' => $leads->where('status', 'cancelled')->count(),
            'conversion_rate' => $totalLeads > 0 ? round(($soldCount / $totalLeads) * 100, 2) : 0,
            
            // Финансовая статистика
            'avg_purchase_price' => $leads->avg('purchase_price') ?? 0,
            'avg_sale_price' => $leads->avg('sale_price') ?? 0,
            'avg_profit' => $soldCount > 0 ? $soldLeads->avg(fn($lead) => $lead->sale_price - $lead->purchase_price) : 0,
            'total_purchase' => $leads->sum('purchase_price'),
            'potential_income' => $leads->sum('sale_price'),
            'actual_income' => $soldLeads->sum('sale_price'),
            'profit' => $soldLeads->sum(fn($lead) => $lead->sale_price - $lead->purchase_price),
            
            // Топ и последние заявки
            'top_profitable' => $this->getTopProfitableLeads($leads),
            'leads_by_date' => $leads->sortByDesc('created_at')->take(10),
            
            // Данные для графиков
            'chartData' => $this->prepareChartData($leads, $soldLeads)
        ];

        $this->dispatch('updateCharts', $this->stats['chartData']);
    }

    protected function prepareChartData(Collection $leads, Collection $soldLeads): array
    {
        return [
            'statusLabels' => ['В ожидании', 'В работе', 'Продано', 'Отменено'],
            'statusValues' => [
                $leads->where('status', 'pending')->count(),
                $leads->where('status', 'in_progress')->count(),
                $soldLeads->count(),
                $leads->where('status', 'cancelled')->count()
            ],
            'financeLabels' => ['Затраты', 'Доход', 'Прибыль'],
            'financeValues' => [
                round($leads->sum('purchase_price'), 2),
                round($soldLeads->sum('sale_price'), 2),
                round($soldLeads->sum(fn($lead) => $lead->sale_price - $lead->purchase_price), 2)
            ],
            'colors' => [
                'status' => ['#FFC107', '#2196F3', '#4CAF50', '#F44336'],
                'finance' => ['#F44336', '#4CAF50', '#2196F3']
            ]
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
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}