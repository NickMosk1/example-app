<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;
use Livewire\WithPagination;

class LeadsTable extends Component
{
    use WithPagination;

    public function render()
    {
        $leads = Lead::paginate(20);
        return view('customPages.leadsTablePage.leads-table-page', [
            'leads' => $leads,
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}