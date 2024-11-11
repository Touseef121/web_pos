<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 100%;
            text-align: center;
        }
        .receipt h3 {
            margin: 0;
            padding: 10px 0;
            font-size: 20px;
        }
        .receipt table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt table, .receipt th, .receipt td {
            border: 1px solid black;
        }
        .receipt th, .receipt td {
            padding: 5px;
            text-align: left;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h3>POS Receipt</h3>
        <p>Order ID: {{ $orderId }}</p>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['price'] * $product['quantity'] }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
        
        <p class="total">Total: {{$product['price']}}</p>
    </div>
</body>
</html>
