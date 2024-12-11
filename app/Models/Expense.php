<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['employee_name', 'expense_type', 'salary_expense' ,'total_salary', 'per_day_salary', 'working_days', 'salary_given', 'created_date', 'created_by_user', 'expense_name', 'description', 'expense_amount'];

    protected $casts = [
        'salary_expense' => 'float',
        'expense_amount' => 'float',
    ];
    

}
