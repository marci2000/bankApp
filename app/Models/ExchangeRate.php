<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function scopeDate($query, $name) {
        return $query->where('bank_id', Bank::id($name))->max('date');
    }
}
