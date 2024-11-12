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
        .total{
            background-color: black;
            color: white;
        }
        .row{
            display: flex;
            justify-content:space-between;
            padding-left:20px;
            padding-right:20px;
        }
        .total{
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h3 class="text-center">POS Receipt</h3>
        <h3 class="text-center">Shop Name</h3>
        <h3 class="text-center">Address</h3>

        <div class="row">
            <h6>
                Bill id: <span>{{ $orderId }}</span>
            </h6>
            <h6>
                Date: <span>{{ $todayDate }}</span>
            </h6>
        </div>
        <div class="row">
            <h6>
                Bill by: <span>{{ $loggedInCashier }}</span>
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

        <h5 class="text-center text-light fw-800 total">Grand Total: <span>{{ $order->total_price }}</span></h5>
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
