@extends('admin.admin-navbar')

@section('title')
    Purchase Details - POS
@endsection

@section('admin-content')
    <div class="box-shadow">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Entry No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Brand</th>
                <th scope="col">Barcode</th>
                <th scope="col">Purchased Units</th>
                <th scope="col">Purchase Cost</th>
                <th scope="col">Tax</th>
                <th scope="col">Discount</th>
                <th scope="col">Per Unit Price</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">Created By</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($details as $details)
                <tr>
                    <th>{{$details->id}}</th>
                    <td>{{$details->product->product_name}}</td>
                    <td>{{$details->category}}</td>
                    <td>{{$details->brand}}</td>
                    <td>{{$details->barcode}}</td>
                    <td>{{$details->purchased_units}}</td>
                    <td>{{$details->purchase_cost}}</td>
                    <td>{{$details->tax}}</td>
                    <td>{{$details->discount}}</td>
                    <td>{{$details->per_unit_price}}</td>
                    <td>{{$details->total_cost}}</td>
                    <td>{{$details->expiry_date}}</td>
                    <td>{{$details->created_by}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
          <a href="{{route('purchases.index')}}" class="btn button1"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
@endsection
