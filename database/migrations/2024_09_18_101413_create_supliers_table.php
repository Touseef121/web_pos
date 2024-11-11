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
        Schema::create('supliers', function (Blueprint $table) {
            $table->id();
            $table->string('suplier_name');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country')->default('Pakistan');
            $table->string('postal_code')->default('00000');
            $table->string('payment_status')->default('Not Available');
            $table->string('bank_details')->default('Not Available');
            $table->string('tax_id');
            $table->string('products_supplied');
            $table->string('description');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supliers');
    }
};
