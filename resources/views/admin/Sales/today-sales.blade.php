@extends('admin.admin-navbar')

@section('title')
    Sales by Cashiers - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('admin-content')

    <head>
        <style>
            .table-container {
                max-height: 400px;
                overflow: auto;
            }

            .box-shadow {
                height: 80% !important;
            }

            thead {
                top: 0;
                position: sticky;
            }
            .salesAmount{
                margin-top: 20px;
                margin-bottom: 0px !important;
                line-height: 1.5;
            }
        </style>
    </head>

    <body>

        <div class="box-shadow mt-5">
            <div>
                <h3 class="text-center">Sales by Cashier</h3>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Cashier Selection Dropdown and Date Filter -->
               <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="cashier-select">Select Cashier:</label>
                        <select id="cashier-select" class="form-control">
                            <option value="">-- Select a Cashier --</option>
                            @foreach ($sales as $cashier)
                                <option value="{{ $cashier->id }}">{{ $cashier->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="col-lg-4">
                    <div class="form-group">
                        <label for="dateFilter">Select Date:</label>
                        <input type="date" id="dateFilter" class="form-control" />
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="searchField">Search:</label>
                            <input type="text" id="searchField" class="form-control"
                                placeholder="Search by Order ID, Total Price, etc." />
                        </div>
                    </div>
               </div>

                <!-- Sales Data Table -->
                <div class="table-container mt-3">
                    @foreach ($sales as $cashier)
                        <div class="cashier-sales" data-cashier-id="{{ $cashier->id }}" style="display: none;">
                            <div style="display: flex; justify-content: space-between; margin-top: 10px;" class="salesAmount">
                                <h4 class="col-lg-5">Cashier: {{ $cashier->user_name }}</h4>
                                <p><strong>Total Sales Amount: </strong><span class="total-amount"
                                        style="background-color: black; padding: 10px; color: white; font-size: 15px; border-radius: 20px;">{{ $cashier->total_sales_amount }}</span>
                                </p>
                            </div>
                            <table class="table mt-3">
                                <thead class="thead text-light" style="background-color: black;">
                                    <tr>
                                        <th scope="col">S No.</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Transaction Id</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="sales-data">
                                    <!-- Sales rows will be inserted here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cashierSelect = document.getElementById('cashier-select');
                const dateFilter = document.getElementById('dateFilter');
                const searchField = document.getElementById('searchField');

                function loadSalesData() {
                    const selectedCashierId = cashierSelect.value;
                    const selectedDate = dateFilter.value;
                    const searchTerm = searchField.value.toLowerCase();

                    // Hide all cashier sales sections initially
                    document.querySelectorAll('.cashier-sales').forEach(function(cashierSales) {
                        cashierSales.style.display = 'none';
                    });

                    if (selectedCashierId) {
                        fetch(`/sales/${selectedCashierId}?date=${selectedDate}`)
                            .then(response => response.json())
                            .then(data => {
                                const selectedCashierSales = document.querySelector(
                                    `.cashier-sales[data-cashier-id="${selectedCashierId}"]`);
                                if (selectedCashierSales) {
                                    selectedCashierSales.style.display = 'block';
                                    const salesDataContainer = selectedCashierSales.querySelector('.sales-data');
                                    salesDataContainer.innerHTML = '';

                                    // Filter sales based on search term
                                    const filteredSales = data.sales.filter(sale =>
                                        sale.order_id.toString().includes(searchTerm) ||
                                        sale.total_price.toString().includes(searchTerm) ||
                                        sale.payment_method.toLowerCase().includes(searchTerm) ||
                                        sale.transaction_id.toString().includes(searchTerm) ||
                                        sale.date.includes(searchTerm)
                                    );

                                    // Display filtered sales
                                    filteredSales.forEach((sale, index) => {
                                        salesDataContainer.innerHTML += `
                               <tr>
                                    <td>${index + 1}</td>
                                    <td>${sale.order_id}</td>
                                    <td>${sale.total_price}</td>
                                    <td>${sale.payment_method}</td>
                                    <td>${sale.transaction_id}</td>
                                    <td>${sale.date}</td>
                                    </tr>
                                    `;
                                    });

                                    selectedCashierSales.querySelector('.total-amount').innerText = data
                                        .total_sales_amount;
                                }
                            });
                    }
                }

                cashierSelect.addEventListener('change', loadSalesData);
                dateFilter.addEventListener('change', loadSalesData);
                searchField.addEventListener('input', loadSalesData); // Trigger search on input change
            });
        </script>
    </body>
@endsection
