@extends('cashier.cashier-nav')

@section('cashier-content')
<style>
            .grandTotal {
                font-size: 20px !important;
                font-weight: 600;
                background-color: black;
                color: White;
                border-radius: 10px;
                padding: 8px;
            }
            .selectedDate {
                font-size: 20px !important;
                font-weight: 600;
                background-color: black;
                color: White;
                border-radius: 10px;
                padding: 8px;
            }
            .date{
                margin-bottom: 15px;
            }
            .total{
                margin-top: 15px;
            }
</style>
<div class="container">
    <h3 class="text-center">Order Details for Order ID: {{ $order->id }}</h3>

    <div class="box-shadow">
        <div style="display: flex; justify-content:space-between;">
            <h4 class="date">Date: <span class="selectedDate">{{ $order->date }}</span></h4>
            <a href="{{route('orders.today')}}" class="button1 mb-4"><i class="fa-solid fa-arrow-left mx-1"></i>Back</a>
        </div>
        <table class="table"> 
            <thead class="thead-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Billed By</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($order->products as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity * $item->price }}</td>
                <td>
                    @if ($order->cashier)
                    {{ $order->cashier->user_name }}
                    @else
                    N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    
    <h3 class="text-center total">Grand Total: <span class="grandTotal">{{ $grandTotal->total_price }}</span></h3>
</div>
</div>
@endsection