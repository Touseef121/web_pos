<?php

namespace App\Models;

use App\Models\PurchaseRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suplier extends Model
{
    use HasFactory;

    protected $fillable = ['suplier_name', 'contact_name', 'contact_number', 'email', 'address', 'city', 'state', 'country', 'postal_code', 'tax_id', 'brand', 'description', 'status'];


    public function inventory()
    {
        return $this->hasMany(Inventroy::class);
    }
    public function record()
    {
        return $this->hasMany(PurchaseRecord::class);
    }
}
