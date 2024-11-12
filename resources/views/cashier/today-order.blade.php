@extends('cashier.cashier-nav')
@section('cashier-content')
    <div class="container">
        <style>
            .table-items {
                height: 400px;
                overflow: auto;
            }
            thead {
                position: sticky;
                top: 0;
                background-color: #f2f2f2;
            }

            #selectedDate {
                font-size: 20px !important;
                font-weight: 600;
                background-color: black;
                color: White;
                border-radius: 10px;
                padding: 8px;
            }

            .dateDiv {
                display: flex;
                justify-content: space-between;
                margin: 10px;
            }

            table {
                text-align: center !important;
            }
        </style>
        <div class="mainDiv">
            <div class="dateDiv">
                <h3>Orders for: <span id="selectedDate">{{ $date }}</span></h3>
                <div>
                    <input type="date" id="searchDate" value="{{ $date }}">
                    <button id="searchOrdersBtn" class="button1">Search</button>
                </div>
            </div>

            <div class="table-items">
                <table class="table">
                    <div class="item-head">
                        <thead class="thead-dark">
                            <tr>
                                <th>S. No</th>
                                <th>Order ID</th>
                                <th>Cashier Name</th>
                                <th>Order Date</th>
                                <th>Payment Method</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                    </div>
                    <tbody>
                        @if ($orders->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No orders found for this date.</td>
                            </tr>
                        @else
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->order_id }}</td>

                                    <!-- Check if cashier exists and retrieve the user_name safely -->
                                    <td>
                                        @if ($order->cashier)
                                            {{ $order->cashier->user_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $order->payment_method}}</td>
                                    <td>{{ $order->transaction_id}}</td>
                                    <td>{{ $order->total_price}}</td>
                                    <td>
                                        <button class="viewDetailsBtn button1" data-id="{{ $order->id }}">View
                                            Details</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Filter orders by selected date
        document.getElementById('searchOrdersBtn').addEventListener('click', function() {
            const date = document.getElementById('searchDate').value;
            window.location.href = `/orders/today?date=${date}`;
        });

        // Fetch and display order details when "View Details" is clicked
        document.querySelectorAll('.viewDetailsBtn').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');
                window.location.href = `/orders/${orderId}/details`;
            });
        });
    </script>
@endsection
