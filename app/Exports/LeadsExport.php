<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters = [];

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Lead::with(['leadSource', 'partner']);

        if (isset($this->filters['partner_id']) && $this->filters['partner_id']) {
            $query->where('partner_id', $this->filters['partner_id']);
        }

        if (isset($this->filters['lead_source_id']) && $this->filters['lead_source_id']) {
            $query->where('lead_source_id', $this->filters['lead_source_id']);
        }

        if (isset($this->filters['status']) && $this->filters['status']) {
            $query->where('status', $this->filters['status']);
        }

        if (isset($this->filters['sort_field']) && isset($this->filters['sort_direction'])) {
            $query->orderBy($this->filters['sort_field'], $this->filters['sort_direction']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
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
            $lead->quantity,
            $lead->type,
            $this->getStatusText($lead->status),
            $lead->leadSource ? $lead->leadSource->name : 'Не указан',
            $lead->partner ? $lead->partner->name : 'Не указан',
            $lead->purchase_price ? number_format($lead->purchase_price, 2) . ' ₽' : '-',
            $lead->sale_price ? number_format($lead->sale_price, 2) . ' ₽' : '-',
            $lead->created_at->format('d.m.Y H:i'),
            $lead->updated_at->format('d.m.Y H:i'),
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