<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit/Loss Report</title>
</head>
<body>
    <h2>Profit/Loss Report from {{ $from }} to {{ $to }}</h2>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Profit/Loss</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->sale_id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->total_price }}</td>
                    <td>{{ $item->profit_loss }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Profit/Loss: {{ $data->sum('profit_loss') }}</h3>
</body>
</html>
