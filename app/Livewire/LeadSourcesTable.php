<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LeadSource;
use Livewire\WithPagination;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class LeadSourcesTable extends Component
{
    use WithPagination;

    public $showStatsModal = false;
    public $currentSource;
    public $stats = [];

    public function showSourceStats($sourceId)
    {
        $this->currentSource = LeadSource::with(['leads'])->findOrFail($sourceId);
        $this->prepareStats();
        $this->showStatsModal = true;
    }

    public function closeStatsModal()
    {
        $this->showStatsModal = false;
    }

    protected function prepareStats()
    {
        $leads = $this->currentSource->leads;
        
        $this->stats = [
            'total_leads' => $leads->count(),
            'sold_leads' => $leads->where('status', 'sold_to_partner')->count(),
            'in_progress' => $leads->where('status', 'in_progress')->count(),
            'total_purchase' => $leads->sum('purchase_price'),
            'potential_income' => $leads->sum('sale_price'),
            'actual_income' => $leads->where('status', 'sold_to_partner')->sum('sale_price'),
            'profit' => $leads->where('status', 'sold_to_partner')->sum(function($lead) {
                return $lead->sale_price - $lead->purchase_price;
            }),
            'top_profitable' => $leads->whereNotNull('sale_price')
                ->sortByDesc(function($lead) {
                    return $lead->sale_price - $lead->purchase_price;
                })->take(5),
            'chartData' => [
                'statusLabels' => ['В ожидании', 'В работе', 'Продано', 'Отменено'],
                'statusValues' => [
                    $leads->where('status', 'pending')->count(),
                    $leads->where('status', 'in_progress')->count(),
                    $leads->where('status', 'sold_to_partner')->count(),
                    $leads->where('status', 'cancelled')->count()
                ],
                'timelineLabels' => $leads->groupBy(function($item) {
                    return $item->created_at->format('d.m.Y');
                })->keys()->toArray(),
                'timelineValues' => $leads->groupBy(function($item) {
                    return $item->created_at->format('d.m.Y');
                })->map->count()->values()->toArray()
            ]
        ];
    }

    public function render()
    {
        return view('customPages.leadSourcesTablePage.lead-sources-table-page', [
            'sources' => LeadSource::paginate(15)
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}