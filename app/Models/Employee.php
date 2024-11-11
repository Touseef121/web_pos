<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'father_name', 'phone_number', 'id_card_number', 'dob', 'salary', 'salary_status', 'picture', 'joining_date', 'leaving_date', 'id_card_picture'];
}
