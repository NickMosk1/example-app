<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    public function storeBulk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leads' => 'required|array',
            'leads.*.full_name' => 'required|string|max:255',
            'leads.*.quantity' => 'required|integer|min:1',
            'leads.*.type' => 'required|string|max:255',
            'leads.*.status' => 'required|string|in:pending,completed,canceled',
            'leads.*.lead_source_id' => 'required|integer' // Обязательное поле
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        $createdLeads = [];
        foreach ($request->input('leads') as $leadData) {
            // Проверяем существование источника
            $leadSource = LeadSource::find($leadData['lead_source_id']);
            
            // Если источник не найден - создаем новый
            if (!$leadSource) {
                $leadSource = LeadSource::create([
                    'id' => $leadData['lead_source_id'], // Сохраняем переданный ID
                    'name' => 'Источник ' . Str::random(8),
                    'is_native' => false,
                    'email' => 'source_' . Str::random(6) . '@example.com',
                    'phone' => '+7' . mt_rand(900, 999) . mt_rand(1000000, 9999999),
                    'min_purchase_price' => mt_rand(10, 50),
                    'max_purchase_price' => mt_rand(51, 100),
                    'min_sale_price' => mt_rand(60, 110),
                    'max_sale_price' => mt_rand(111, 200),
                    'total_leads' => 0,
                ]);
            }

            // Создаем заявку
            $lead = Lead::create([
                'full_name' => $leadData['full_name'],
                'quantity' => $leadData['quantity'],
                'type' => $leadData['type'],
                'status' => $leadData['status'],
                'lead_source_id' => $leadSource->id,
                'purchase_price' => $leadSource->is_native ? null : $this->getRandomPrice(
                    $leadSource->min_purchase_price, 
                    $leadSource->max_purchase_price
                ),
                'sale_price' => $leadSource->is_native ? null : $this->getRandomPrice(
                    $leadSource->min_sale_price, 
                    $leadSource->max_sale_price
                ),
            ]);
            
            $createdLeads[] = $lead;
            
            // Увеличиваем счетчик заявок у источника
            $leadSource->increment('total_leads');
        }

        return response()->json([
            'message' => 'Leads created successfully',
            'data' => $createdLeads
        ], 201);
    }

    protected function getRandomPrice(float $min, float $max): float
    {
        return mt_rand($min * 100, $max * 100) / 100;
    }
}