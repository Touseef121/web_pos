<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    protected $fillable = [
        'cashier_id',
        'rs_10',
        'rs_20',
        'rs_50',
        'rs_100',
        'rs_500',
        'rs_1000',
        'rs_5000',
        'total_amount',
        'popup_shown_at'
    ];
    
        public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}
