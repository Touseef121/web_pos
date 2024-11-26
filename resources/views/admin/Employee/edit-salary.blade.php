@extends('admin.admin-navbar')
 
@section('title')
    Salary Update - POS
@endsection

@section('admin-content')
<h3 class="text-center">Edit Salary for Employee: "{{ $employee->name }}"</h3>
<div class="container profile-container1">
    <form action="{{ route('update.salary', $employee->id) }}" method="POST" id="salary-form" class="profile-form">
        @csrf
        <div>
            <label for="total_salary">Total Salary:</label>
            <input type="number" id="total_salary" name="total_salary" value="{{$employee->salary}}" class="form-control" required>
        </div>

        <div>
            <label for="working_days">Working Days:</label>
            <input type="number" id="working_days" name="working_days" class="form-control" required>
        </div>

        <div>
            <label for="per_day_salary">Per Day Salary:</label>
            <input type="text" id="per_day_salary" class="form-control" readonly>
        </div>

        <div>
            <label for="calculated_salary">Calculated Salary:</label>
            <input type="text" id="calculated_salary" class="form-control" readonly>
        </div>

        <button type="submit" class="button1 mt-3">Update Salary</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#total_salary, #working_days').on('input', function () {
            const totalSalary = parseFloat($('#total_salary').val()) || 0;
            const workingDays = parseInt($('#working_days').val()) || 0;
            const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

            const perDaySalary = totalSalary / daysInMonth;
            const calculatedSalary = perDaySalary * workingDays;

            $('#per_day_salary').val(perDaySalary.toFixed(2));
            $('#calculated_salary').val(calculatedSalary.toFixed(2));
        });
    });
</script>
@endsection