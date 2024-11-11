<?php

namespace App\Models;

use App\Models\Cashier;
use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public function cashier(){
        return $this->belongsTo(User::class, 'cashier_id');
    }

    
    protected $fillable = ['order_id', 'cashier_id', 'total_price'];

    public function products()
    {
        return $this->hasMany(SaleItem::class);
    }

}
