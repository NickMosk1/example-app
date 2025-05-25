<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;
use App\Models\LeadSource;

class CreateLead extends Component
{
    public $quantity = 1;
    public $type;
    public $status;
    public $source_id;
    public $showSourceForm = false;
    public $purchase_price;
    public $sale_price;
    
    public $newSourceName;
    public $newSourceEmail;
    public $newSourcePhone;
    public $newSourceMinPurchase = 0;
    public $newSourceMaxPurchase = 0;
    public $newSourceMinSale = 100;
    public $newSourceMaxSale = 150;

    protected function rules()
    {
        $rules = [
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string|max:255',
            'status' => 'required|string',
            'source_id' => 'required',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ];

        if ($this->showSourceForm) {
            $rules = array_merge($rules, [
                'newSourceName' => 'required|string|max:255',
                'newSourceEmail' => 'required|email|max:255',
                'newSourcePhone' => 'required|string|max:20',
                'newSourceMinPurchase' => 'required|numeric|min:0',
                'newSourceMaxPurchase' => 'required|numeric|min:0|gte:newSourceMinPurchase',
                'newSourceMinSale' => 'required|numeric|min:0',
                'newSourceMaxSale' => 'required|numeric|min:0|gte:newSourceMinSale',
            ]);
        } elseif (is_numeric($this->source_id)) {
            $source = LeadSource::find($this->source_id);
            if ($source) {
                $rules['purchase_price'] = [
                    'required',
                    'numeric',
                    'min:'.$source->min_purchase_price,
                    'max:'.$source->max_purchase_price,
                ];
                $rules['sale_price'] = [
                    'required',
                    'numeric',
                    'min:'.$source->min_sale_price,
                    'max:'.$source->max_sale_price,
                ];
            }
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'purchase_price.between' => 'Цена покупки должна быть между :min и :max для выбранного источника',
            'sale_price.between' => 'Цена продажи должна быть между :min и :max для выбранного источника',
            'newSourceMaxPurchase.gte' => 'Макс. цена покупки должна быть больше или равна мин. цене',
            'newSourceMaxSale.gte' => 'Макс. цена продажи должна быть больше или равна мин. цене',
            'quantity.min' => 'Количество не может быть меньше 1',
            'purchase_price.min' => 'Цена покупки не может быть отрицательной',
            'sale_price.min' => 'Цена продажи не может быть отрицательной',
        ];
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'source_id') {
            $this->showSourceForm = ($this->source_id === 'new');
            $this->validateOnly('purchase_price');
            $this->validateOnly('sale_price');
        }

        if (in_array($propertyName, ['purchase_price', 'sale_price', 'source_id'])) {
            $this->validateOnly('purchase_price');
            $this->validateOnly('sale_price');
        }
    }

    public function create()
    {
        $this->validate();

        if ($this->showSourceForm) {
            $source = LeadSource::create([
                'name' => $this->newSourceName,
                'is_native' => false,
                'total_leads' => 0,
                'email' => $this->newSourceEmail,
                'phone' => $this->newSourcePhone,
                'min_purchase_price' => $this->newSourceMinPurchase,
                'max_purchase_price' => $this->newSourceMaxPurchase,
                'min_sale_price' => $this->newSourceMinSale,
                'max_sale_price' => $this->newSourceMaxSale,
            ]);
            $this->source_id = $source->id;
        }

        Lead::create([
            'quantity' => $this->quantity,
            'type' => $this->type,
            'status' => $this->status,
            'lead_source_id' => $this->source_id,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
        ]);

        session()->flash('success', 'Заявка успешно создана.');
        return redirect()->route('leads.table');
    }

    public function render()
    {
        $sources = LeadSource::all();
        $priceRanges = null;
        
        if (!$this->showSourceForm && is_numeric($this->source_id)) {
            $source = LeadSource::find($this->source_id);
            if ($source) {
                $priceRanges = [
                    'min_purchase' => $source->min_purchase_price,
                    'max_purchase' => $source->max_purchase_price,
                    'min_sale' => $source->min_sale_price,
                    'max_sale' => $source->max_sale_price,
                ];
            }
        }
        
        return view('customPages.createLeadPage.create-lead-page', [
            'sources' => $sources,
            'priceRanges' => $priceRanges,
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}