@extends('layout')
<!DOCTYPE html>
<html>

<head>
    <style>
        body{
            display: flex;
            justify-content: center;
            height: 100%;
            /* width: 100%; */
        }
        span{
            font-size: 15px;
            font-weight: 500;
        }
        .receipt{
            padding: 25px;
            height: 100%;
            width: 100%;
        }
        thead>tr>th{ 
            font-weight: 800 !important;
        }
        .row{
            display: flex;
            justify-content:space-between;
            padding-left:20px;
            padding-right:20px;
        }
        h6{
            font-size: 16px !important;
            font-weight: 700 !important;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h3 class="text-center">POS Receipt</h3>
        <h3 class="text-center">Shop Name</h3>
        <h3 class="text-center">Address</h3>

            <div class="row mt-5 mb-2">
                <h6 class="text-center">
                    Date: <span>{{ $todayDate }}</span>
                </h6>
                <h6 class="text-center">
                    Cashier Name: <span>{{ $loggedInCashier }}</span>
                </h6>
            </div>
            <div class="row">
                <h6 class="text-center">
                    Bill #: <span>{{ $orderId }}</span>
                </h6>
                <h6 class="text-center">
                    Bill Time: <span>{{ $time }}</span>
                </h6>
            </div>
        <div style="display: flex; justify-content:center;">

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Products</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $order)
                <tr>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->quantity * $order->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            <hr class="text-dark">
            <h5 class="text-center text-dark fw-800 total">Grand Total: <span>{{ $order->total_price }}</span></h5>
            <hr class="text-dark">
            <div class="mt-5 text-center">
                <h6>Software By: <span>Company Name</span></h6>
            </div>
    </div>
    <script>
        $(document).ready(function() {
            var dt = new Date();
            var time = dt.getHours() + ":" + dt.getMinutes();
            $('#time').text(time);
        });
    </script>

</body>

</html>
