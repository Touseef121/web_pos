<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryRecord extends Model
{
    protected $fillable = ['employee_id', 'month_year', 'total_salary', 'per_day_salary', 'working_days', 'calculated_salary', 'salary_status'];
}
