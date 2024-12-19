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
        Schema::create('petty_cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained('users')->onDelete('cascade'); // References users table
            $table->integer('rs_10')->default(0);
            $table->integer('rs_20')->default(0);
            $table->integer('rs_50')->default(0);
            $table->integer('rs_100')->default(0);
            $table->integer('rs_500')->default(0);
            $table->integer('rs_1000')->default(0);
            $table->integer('rs_5000')->default(0);
            $table->integer('total_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_cashes');
    }
};
