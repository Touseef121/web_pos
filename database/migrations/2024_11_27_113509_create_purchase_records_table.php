<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('category');
            $table->string('brand');
            $table->string('barcode');
            $table->string('purchased_units');
            $table->string('purchase_cost');
            $table->string('tax');
            $table->string('discount'); 
            $table->string('price_with_gst');
            $table->string('per_unit_price');
            $table->string('total_cost');
            $table->string('created_by');
            $table->string('expiry_date');
            $table->string('created_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_records');
    }
};
