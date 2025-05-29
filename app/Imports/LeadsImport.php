<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Validation\Rule;

class LeadsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    private $rows = 0;
    private $failures = [];

    public function model(array $row)
    {
        ++$this->rows;
        
        if (empty($row['quantity']) && empty($row['type']) && empty($row['lead_source_id'])) {
            return null;
        }

        return new Lead([
            'quantity' => $this->validateQuantity($row['quantity']),
            'type' => $this->validateType($row['type']),
            'status' => $this->normalizeStatus($row['status'] ?? 'pending'),
            'lead_source_id' => $this->validateSource($row['lead_source_id']),
        ]);
    }

    protected function validateQuantity($value)
    {
        if (!is_numeric($value)) {
            throw new \Exception("Количество должно быть числом");
        }
        return (int) $value;
    }

    protected function validateType($value)
    {
        $value = trim($value);
        if (empty($value)) {
            throw new \Exception("Тип не может быть пустым");
        }
        return $value;
    }

    protected function validateSource($value)
    {
        if (!is_numeric($value)) {
            throw new \Exception("ID источника должен быть числом");
        }
        return (int) $value;
    }

    protected function normalizeStatus($status)
    {
        $statuses = [
            'in_progress' => 'in_progress',
            'в работе' => 'in_progress',
            'pending' => 'pending',
            'ожидание' => 'pending',
            'sold' => 'sold_to_partner',
            'cancelled' => 'cancelled'
        ];

        return $statuses[strtolower(trim($status))] ?? 'pending';
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'numeric', 'min:1'],
            'type' => ['required', 'string', 'max:255'],
            'lead_source_id' => ['required', 'numeric', 'exists:lead_sources,id'],
            'status' => ['nullable', Rule::in(['pending', 'in_progress', 'sold_to_partner', 'cancelled'])],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'quantity.required' => 'Строка :row: Поле "Количество" обязательно',
            'type.required' => 'Строка :row: Поле "Тип" обязательно',
            'lead_source_id.exists' => 'Строка :row: Источник с ID :value не существует',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->failures[] = [
                'row' => $failure->row(),
                'errors' => $failure->errors(),
                'values' => $failure->values()
            ];
        }
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function getFailures(): array
    {
        return $this->failures;
    }
}