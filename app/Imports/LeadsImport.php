<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LeadsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Lead([
            'quantity'      => $row['quantity'] ?? $row['количество'] ?? 1,
            'type'          => $row['type'] ?? $row['тип'] ?? $row['продукт'] ?? 'Не указан',
            'status'        => $row['status'] ?? $row['статус'] ?? 'pending',
            'lead_source_id'=> $row['lead_source_id'] ?? $row['источник'] ?? 1,
        ]);
    }
    
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric',
            'type' => 'required',
            'lead_source_id' => 'required|numeric',
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            'quantity.required' => 'Поле Количество обязательно для заполнения',
            'quantity.numeric' => 'Количество должно быть числом',
            'type.required' => 'Поле Тип обязательно для заполнения',
            'lead_source_id.required' => 'Необходимо указать источник',
            'lead_source_id.numeric' => 'ID источника должен быть числом',
        ];
    }
}