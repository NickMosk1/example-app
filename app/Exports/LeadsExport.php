<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Lead::with(['leadSource', 'partner'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'ФИО',
            'Количество',
            'Тип продукта',
            'Статус',
            'Источник',
            'Партнер',
            'Цена покупки',
            'Цена продажи',
            'Дата создания',
            'Дата обновления'
        ];
    }

    public function map($lead): array
    {
        return [
            $lead->id,
            $lead->full_name,
            $lead->quantity,
            $lead->type,
            $this->getStatusText($lead->status),
            $lead->leadSource ? $lead->leadSource->name : 'Не указан',
            $lead->partner ? $lead->partner->name : 'Не указан',
            $lead->purchase_price,
            $lead->sale_price,
            $lead->created_at,
            $lead->updated_at,
        ];
    }

    private function getStatusText($status)
    {
        $statuses = [
            'pending' => 'В ожидании',
            'in_progress' => 'В работе',
            'sold_to_partner' => 'Продана партнеру',
            'cancelled' => 'Отменена',
        ];
        
        return $statuses[$status] ?? $status;
    }
}