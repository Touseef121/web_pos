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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->foreignId('cashier_id')->constrained('users'); // Assuming there is a users table
            $table->date('date')->default(date("Y-m-d"));            
            $table->string('payment_method')->default('Cash Payment');
            $table->string('transaction_id')->default('No id');
            $table->decimal('total_price', 10, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
