@extends('admin.admin-navbar')

@section('title')
    All Expenses - POS
@endsection

@section('admin-content')
    <style>
        .salary{
            height: 60vh;
            overflow: scroll;
        }
        .other{
            height: 60vh;
            overflow: scroll;
        }
        .total-expense{
            display: flex;
            justify-content: left;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
    <div class="box-shadow">
        <h3 class="text-center">Expenses</h3>
        <div class="total-expense">
            <h4 class="text-center price-box">Total Expense: <span id="total-expense-amount" class="fw-800" style="font-size: 20px;">0.00</span></h4>
        </div>
        <form action="">
            <div class="row">
                <div class="col-lg-6">
                    <label for="expense-type">Expenses Type</label>
                    <select name="expense_type" id="expense-type" class="form-control">
                        <option value="">Select Expense type</option>
                        <option value="other">Other Expenses</option>
                        <option value="salary">Salary Expenses</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="from-date">From Date</label>
                    <input type="date" id="from-date" class="form-control">
                </div>
                <div class="col-lg-3">
                    <label for="to-date">To Date</label>
                    <input type="date" id="to-date" class="form-control">
                </div>
            </div>
        </form>
        <div class="other">
            <h3 class="text-center">other Expenses</h3>
            <table class="table">
                <thead class="thead-dark" style="position: sticky; top:0;">
                  <tr>
                    <th scope="col">Expense Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Expense Amount</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Created By</th>
                  </tr>
                </thead>
                <tbody id="otherTbody">
                </tbody>
              </table>
        </div>
        <div class="salary">
            <h3 class="text-center">Salary Expenses</h3>
            <table class="table">
                <thead class="thead-dark"  style="position: sticky; top:0;">
                  <tr>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Total Salary</th>
                    <th scope="col">Per Day Salary</th>
                    <th scope="col">Working Days</th>
                    <th scope="col">Calculated Salary</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Created By</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
              </table>
        </div>
    </div>


    <script>
       $(document).ready(function () {
    $('.salary').hide();
    $('.other').hide();
    $('#total-expense-amount').text('0.00');

    $('#expense-type').on('change', function () {
        const expenseType = $(this).val();
        $('#from-date, #to-date').prop('disabled', !expenseType);
        clearTablesAndTotal();

        if (expenseType === "other") {
            $('.salary').hide();
            $('.other').show();
        } else if (expenseType === "salary") {
            $('.other').hide();
            $('.salary').show();
        } else {
            $('.salary, .other').hide();    
        }
    });

    $('#from-date, #to-date').on('change', function () {
        const fromDate = $('#from-date').val();
        const toDate = $('#to-date').val();
        const expenseType = $('#expense-type').val();

        if (fromDate && toDate && expenseType) {
            fetchExpenses(expenseType, fromDate, toDate);
        }
    });

    function clearTablesAndTotal() {
        $('#otherTbody').empty();
        $('#tbody').empty();
        $('#total-expense-amount').text('0.00');
    }

    function fetchExpenses(type, fromDate, toDate) {
    const url = type === "other" ? '/get-other-expense-data' : '/get-expense-data';

    $.ajax({
        type: 'GET',
        url: url,
        data: { from_date: fromDate, to_date: toDate },
        dataType: 'json',
        success: function (response) {
            const data = type === "other" ? response.otherData : response.data;
            const target = type === "other" ? '#otherTbody' : '#tbody';

            let totalAmount = 0;
            $(target).empty();

            if (data.length > 0) {
                $.each(data, function (key, item) {
                    // Convert null or undefined values to 0 before adding
                    const amount = parseFloat(item.expense_amount || item.salary_expense || 0);
                    totalAmount += amount;

                    const row = (type === "other") ?
                        `<tr>
                            <th scope="row">${item.expense_name}</th>
                            <td>${item.description}</td>
                            <td>${item.expense_amount || 0}</td>
                            <td>${item.created_date}</td>
                            <td>${item.created_by_user}</td>
                        </tr>` :
                        `<tr>
                            <th scope="row">${item.employee_name}</th>
                            <td>${item.total_salary || 0}</td>
                            <td>${item.per_day_salary || 0}</td>
                            <td>${item.working_days || 0}</td>
                            <td>${item.salary_expense || 0}</td>
                            <td>${item.created_date}</td>
                            <td>${item.created_by_user}</td>
                        </tr>`;

                    $(target).append(row);
                });
            } else {
                $(target).append('<tr><td colspan="7" class="text-center">No records found for the selected date range.</td></tr>');
            }

            // Update Total Expense Amount
            $('#total-expense-amount').text(totalAmount.toFixed(2));
        },
        error: function (error) {
            console.error(error);
        }
    });
}
});


    </script>
@endsection