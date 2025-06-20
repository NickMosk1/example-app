<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LeadSource;

class CreateLeadSource extends Component
{
    public $name;
    public $email;
    public $phone;
    public $minPurchase = 0;
    public $maxPurchase = 0;
    public $minSale = 100;
    public $maxSale = 150;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'minPurchase' => 'required|numeric|min:0',
            'maxPurchase' => 'required|numeric|min:0|gte:minPurchase',
            'minSale' => 'required|numeric|min:0',
            'maxSale' => 'required|numeric|min:0|gte:minSale',
        ];
    }

    protected function messages()
    {
        return [
            'maxPurchase.gte' => 'Макс. цена покупки должна быть больше или равна мин. цене',
            'maxSale.gte' => 'Макс. цена продажи должна быть больше или равна мин. цене',
            'minPurchase.min' => 'Цена не может быть отрицательной',
            'minSale.min' => 'Цена не может быть отрицательной',
        ];
    }

    public function create()
    {
        $this->validate();

        $source = LeadSource::create([
            'name' => $this->name,
            'is_native' => false,
            'total_leads' => 0,
            'email' => $this->email,
            'phone' => $this->phone,
            'min_purchase_price' => $this->minPurchase,
            'max_purchase_price' => $this->maxPurchase,
            'min_sale_price' => $this->minSale,
            'max_sale_price' => $this->maxSale,
        ]);

        session()->flash('success', 'Источник успешно создан.');
        return redirect()->route('leads.table');
    }

    public function render()
    {
        return view('customPages.createLeadSourcePage.create-lead-source-page');
    }
}