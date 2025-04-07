<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'quantity',
        'type',
        'status',
        'lead_source_id',
        'partner_id',
        'purchase_price',
        'sale_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public static function getStatuses()
    {
        return ['pending', 'in_progress', 'sold_to_partner', 'cancelled'];
    }

    public function leadSource(): BelongsTo
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    protected static function booted()
    {
        static::creating(function ($lead) {
            if ($lead->lead_source_id) {
                $source = LeadSource::find($lead->lead_source_id);
                
                // Если источник не нативный, устанавливаем случайные цены
                if (!$source->is_native) {
                    $lead->purchase_price = mt_rand(
                        $source->min_purchase_price * 100,
                        $source->max_purchase_price * 100
                    ) / 100;
                    
                    $lead->sale_price = mt_rand(
                        $source->min_sale_price * 100,
                        $source->max_sale_price * 100
                    ) / 100;
                }
                
                // Увеличиваем счетчик заявок у источника
                $source->increment('total_leads');
            }
        });
    }
}