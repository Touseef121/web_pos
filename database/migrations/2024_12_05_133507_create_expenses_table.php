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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_name')->default('NULL');
            $table->string('description')->default('NULL');
            $table->string('expense_type')->default('NULL');
            $table->string('employee_name')->default('NULL');
            $table->string('total_salary')->default('NULL');
            $table->string('per_day_salary')->default('NULL');
            $table->string('monthly_days')->default('NULL');
            $table->string('working_days')->default('NULL');
            $table->string('salary_expense')->default('NULL');
            $table->string('expense_amount')->default('NULL');
            $table->string('created_date')->default('NULL');
            $table->string('created_by_user')->default('NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
