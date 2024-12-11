<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'product_name', 'quantity', 'price', 'total_price', 'profit_loss'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
