<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Console\Command;

class UpdateSalaryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-salary-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {
        $today = Carbon::now();
        $employees = Employee::whereDay('joining_date', $today->day)
                            ->get();

        foreach ($employees as $employee) {
            $employee->update(['salary_status' => "UnPaid"]);
        }

        $this->info('Salary status updated for employees with today\'s joining date.');
}

}
