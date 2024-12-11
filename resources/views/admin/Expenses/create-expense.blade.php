@extends('admin.admin-navbar')

@section('title')
    Expense Page - POS
@endsection

@section('admin-content')

<style>
    .other-section{
        display: none;
    }
    .salary-section{
        display: none;
    }
</style>
        <form action="{{ route('save.expense') }}" method="POST" class="p-5">
            @csrf
            <div class="box-shadow my-2">
                <h4 class="text-center my-3">Add A New Expense</h4>
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @error('expense_name')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('description')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('expense_amount')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('created_date')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('created_by_user')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('employee_name')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('total_salary')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('per_day_salary')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('working_days')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('salary_expense')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-lg-12">
                        <label for="expense-type" class="col-form-label">Expense Type <span class="text-danger">*</span></label>
                        <select name="expense_type" id="expense-type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="salary">Employee Salary</option>
                            <option value="other">Other Expense</option>
                        </select>
                    </div>
                    <div class="col-lg-6 other-section">
                        <label for="expense-name" class="col-form-label">Expense Name<span class="text-danger">*</span></label>
                        <input type="text" min="0" name="expense_name" id="expense-name" class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 other-section">
                        <label for="description" class="col-form-label">Description<span class="text-danger">*</span></label>
                        <textarea type="text" min="0" name="description" id="description" class="form-control calc-total"></textarea>
                    </div>
                    <div class="col-lg-6 other-section">
                        <label for="expense_amount" class="col-form-label">Expense Amount<span class="text-danger">*</span></label>
                        <input type="number" min="0" name="expense_amount" id="expense_amount" class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 other-section">
                        <label for="created_date" class="col-form-label">Created Date<span class="text-danger">*</span></label>
                        <input type="date" min="0" name="created_date" id="created_date" value="{{$date}}" class="form-control calc-total">
                    </div>

                    <div class="col-lg-6 other-section">
                        <label for="created_by_user" class="col-form-label">Created By<span class="text-danger">*</span></label>
                        <input type="text" min="0" name="created_by_user" id="created_by_user" value="{{$user}}" readonly class="form-control calc-total">
                    </div>
                    
                    
                    <div class="col-lg-6 salary-section">
                        <label for="employee_name" class="col-form-label">Employee Name<span class="text-danger">*</span></label>
                        <input type="text" min="0" name="employee_name" id="employee_name" class="form-control">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="monthly-days" class="col-form-label">Days of Months<span class="text-danger">*</span></label>
                        <input type="number" min="0" name="monthly_days" id="monthly-days" value="31" class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="total-salary" class="col-form-label">Total Salary<span class="text-danger">*</span></label>
                        <input type="number" min="0" name="total_salary" id="total-salary" class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="working-days" class="col-form-label">Working Days Salary<span class="text-danger">*</span></label>
                        <input type="number" min="0" name="working_days" id="working-days" class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="per-day-salary" class="col-form-label">Per Day Salary<span class="text-danger">*</span></label>
                        <input type="number" min="0" readonly name="per_day_salary" id="per-day-salary" class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="calculated-salary" class="col-form-label">Salary Given<span class="text-danger">*</span></label>
                        <input type="number" min="0" name="salary_expense" id="calculated-salary" readonly class="form-control calc-total">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="created_date" class="col-form-label">Created Date</label>
                        <input type="date" name="created_date" id="created_date" value="{{$date}}" class="form-control">
                    </div>
                    <div class="col-lg-6 salary-section">
                        <label for="created_by_user" class="col-form-label">Created By<span class="text-danger">*</span></label>
                        <input type="text" min="0" name="created_by_user" id="created_by_user" value="{{$user}}" readonly class="form-control calc-total">
                    </div>
                    <div class="col-12 my-4">
                        <input type="submit" value="Save Product" title="Save Product" class="button1">
                    </div>
                </div>
            </div>
        </form>

        <script>
            $(document).ready(function () {
                $('#expense-type').on('change', function () {
                    if ($(this).val() === 'other') {
                        $('.other-section').css('display','block');
                        $('.salary-section').css('display','none');
                    } else if($(this).val() === 'salary'){
                        $('.salary-section').css('display','block');
                        $('.other-section').css('display','none');
                    } else {
                        $('.salary-section').css('display','none');
                        $('.other-section').css('display','none');
                    }
                });

                $('.calc-total').on('input', function(){
                    let totalSalary = $('#total-salary').val();
                    let monthlyDays = $('#monthly-days').val();
                    let workingDays = $('#working-days').val();

                    let perDaySalary = totalSalary / monthlyDays;
                    let calculatedSalary = perDaySalary * workingDays;
                    $('#per-day-salary').val(perDaySalary.toFixed(0));
                    $('#calculated-salary').val(calculatedSalary.toFixed(0));
                    
                });
            });

        </script>
@endsection