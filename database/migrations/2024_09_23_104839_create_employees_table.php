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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('phone_number');
            $table->string('id_card_number');
            $table->string('id_card_picture')->default('No Picture');
            $table->string('dob');
            $table->string('salary');
            $table->string('salary_status')->default('UnPaid');
            $table->string('picture')->default('No Image');
            $table->string('joining_date');
            $table->string('leaving_date')->default('NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
