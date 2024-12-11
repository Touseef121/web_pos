@extends('admin.admin-navbar')

@section('title')
    Profit/Loss Section - POS
@endsection

@section('admin-content')
    <div class="box-shadow">
        <h3 class="text-center">Profit/Loss Report</h3>
        <div class="row mb-4">
            <div class="col-lg-6">
                <label for="from-date">From Date</label>
                <input type="date" id="from-date" class="form-control">
            </div>
            <div class="col-lg-6">
                <label for="to-date">To Date</label>
                <input type="date" id="to-date" class="form-control">
            </div>
        </div>
        <button id="fetch-report" class="btn btn-primary mb-3">Fetch Report</button>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Sale ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Profit/Loss</th>
                </tr>
            </thead>
            <tbody id="report-tbody"></tbody>
        </table>
        <div style="display: flex; justify-content:space-between;" class="mt-5">
            <h5 class="text-right mx-3">Total Profit/Loss: <span id="total-profit-loss" class="price-box" style="font-size: 20px; font-weight:800;">0.00</span></h5>
            <button id="download-report" class="btn button1 mb-3"> <i class="fa fa-download"></i> Download Report</button>
        </div>
    </div>

    <script>
       $(document).ready(function () {
    $('#fetch-report').on('click', function () {
        const fromDate = $('#from-date').val();
        const toDate = $('#to-date').val();

        if (!fromDate || !toDate) {
            alert("Please select both From and To dates.");
            return;
        }

        fetchProfitLoss(fromDate, toDate);
    });

    $('#download-report').on('click', function () {
        const fromDate = $('#from-date').val();
        const toDate = $('#to-date').val();

        if (!fromDate || !toDate) {
            alert("Please select both From and To dates.");
            return;
        }

        window.location.href = '/download-profit-loss-report?from=' + fromDate + '&to=' + toDate;
    });

    function fetchProfitLoss(fromDate, toDate) {
        $.ajax({
            url: "{{ route('fetch.profit.loss') }}",
            method: 'GET',
            data: { from: fromDate, to: toDate },
            dataType: 'json',
            success: function (response) {
                $('#report-tbody').empty();
                let totalProfitLoss = 0;

                response.data.forEach(item => {
                    $('#report-tbody').append(`
                        <tr>
                            <td>${item.sale_id}</td>
                            <td>${item.product_name}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price}</td>
                            <td>${item.total_price}</td>
                            <td>${item.profit_loss}</td>
                        </tr>
                    `);
                    totalProfitLoss += parseFloat(item.profit_loss);
                });

                $('#total-profit-loss').text(totalProfitLoss.toFixed(2));
            },
            error: function (error) {
                console.error(error);
                alert("An error occurred while fetching the report.");
            }
        });
    }
});
    </script>
@endsection
