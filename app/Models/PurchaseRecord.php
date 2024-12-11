<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRecord extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'category', 'brand', 'barcode', 'purchased_units', 'purchase_cost', 'tax', 'discount', 'per_unit_price', 'price_with_gst','total_cost', 'created_by','expiry_date' , 'created_date', 'suplier_name'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function suplier()
    {
        return $this->hasMany(Suplier::class);
    }
}
