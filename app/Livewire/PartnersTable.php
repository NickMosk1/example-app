<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Partner;
use App\Models\User;
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
    public $partnerUsers = [];
    public $activeTab = 'stats';

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
    
    public function delete($partnerId)
    {
        try {
            $partner = Partner::findOrFail($partnerId);
            $partner->delete();
            
            session()->flash('message', 'Партнер успешно удален');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при удалении: ' . $e->getMessage());
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
        $this->currentPartner = Partner::with(['leads', 'users.roles'])->findOrFail($partnerId);
        $this->partnerUsers = $this->currentPartner->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'roles' => $user->getRoleNames()->join(', '),
                'created_at' => $user->pivot->created_at
            ];
        });
        $this->prepareStats();
        $this->showStatsModal = true;
    }

    public function setActiveTab($tab): void
    {
        $this->activeTab = $tab;
    }

    protected function prepareStats(): void
    {
        $leads = $this->currentPartner->leads;
        $completedLeads = $leads->where('status', 'sold_to_partner');
        
        $totalLeads = $leads->count();
        $completedCount = $completedLeads->count();
        
        $this->stats = [
            'total_leads' => $totalLeads,
            'completed_deals' => $completedCount,
            'in_progress' => $leads->where('status', 'in_progress')->count(),
            'cancelled' => $leads->where('status', 'cancelled')->count(),
            'conversion_rate' => $totalLeads > 0 ? round(($completedCount / $totalLeads) * 100, 2) : 0,
            
            'avg_deal_amount' => $completedLeads->avg('sale_price') ?? 0,
            'total_turnover' => $completedLeads->sum('sale_price'),
            'avg_profit' => $completedCount > 0 ? $completedLeads->avg(fn($lead) => $lead->sale_price - $lead->purchase_price) : 0,
            'total_profit' => $completedLeads->sum(fn($lead) => $lead->sale_price - $lead->purchase_price),
            
            'top_deals' => $this->getTopDeals($completedLeads),
            'recent_deals' => $leads->sortByDesc('created_at')->take(10),
        ];
    }

    protected function getTopDeals(Collection $leads): Collection
    {
        return $leads->sortByDesc('sale_price')
            ->take(5);
    }

    public function closeStatsModal(): void
    {
        $this->showStatsModal = false;
        $this->reset(['currentPartner', 'stats', 'partnerUsers', 'activeTab']);
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

    public function contactUser($userId): void
    {
        $user = User::find($userId);
        $this->dispatch('notify', 
            type: 'info',
            message: "Контактные данные: {$user->email}, {$user->phone}"
        );
    }

    public function render()
    {
        $partners = Partner::withCount('leads')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        
        return view('customPages.partnersTablePage.partners-table-page', [
            'partners' => $partners,
        ]);
    }
}