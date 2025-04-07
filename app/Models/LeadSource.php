<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeadSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_native',
        'total_leads',
        'email',
        'phone',
        'min_purchase_price',
        'max_purchase_price',
        'min_sale_price',
        'max_sale_price',
    ];

    protected $casts = [
        'is_native' => 'boolean',
    ];

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}