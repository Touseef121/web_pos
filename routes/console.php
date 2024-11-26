<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\UpdateSalaryStatus;
use App\Console\Commands\ResetEmployeeSalaryStatus;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::command(ResetEmployeeSalaryStatus::class)->daily();
Schedule::command(UpdateSalaryStatus::class)->daily();

