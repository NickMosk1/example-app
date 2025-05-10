<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'partner_user');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}