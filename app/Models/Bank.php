<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exchangeRates() {
        return $this->hasMany(ExchangeRate::class, 'bank_id');
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class, 'bank_id');
    }

    public function scopeId($query, $name) {
        return $query->where('name', $name)->firstOrFail()->id;
    }
}
