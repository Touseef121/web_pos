<?php

namespace App\Models;

use App\Models\Inventory;
use App\Models\PurchaseRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

   protected $fillable = ['product_name', 'category', 'brand', 'barcode', 'suplier_id', 'expiry_date'];

   public function inventory()
   {
       return $this->hasOne(Inventory::class);
   }
   public function record()
   {
       return $this->hasOne(PurchaseRecord::class);
   }

   
   

}
