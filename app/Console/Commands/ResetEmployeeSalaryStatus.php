<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetEmployeeSalaryStatus extends Command
{
    protected $signature = 'app:reset-employee-salary-status';

    
    protected $description = 'Command description';

    public function handle()
    {
        try {
            $today = Carbon::now()->day;
    
            DB::table('employees')
                ->whereDay('joining_date', $today)
                ->update(['salary_status' => 'UnPaid']);
    
            $this->info('Employee salary status reset to UnPaid for employees whose joining date matches today.');
        } catch (\Exception $e) {
            $this->error('Failed to reset salary status: ' . $e->getMessage());
        }
}
}