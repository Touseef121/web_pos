@extends('admin.admin-navbar')

@section('title')
    Purchases - POS
@endsection

@section('admin-content')
    <div class="box-shadow">
        <h2 class="text-center my-3">All Purchases</h2>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">S. no</th>
                <th scope="col">Brand</th>
                <th scope="col">Category</th>
                <th scope="col">Total Price</th>
                <th scope="col">Date</th>
                <th scope="col">Created By</th>
                <th scope="col">View Details</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $data)
              <tr>
                <th scope="row">{{$data->id}}</th>
                <td>{{$data->brand}}</td>
                <td>{{$data->category}}</td>
                <td>{{$data->total_cost}}</td>
                <td>{{$data->created_date}}</td>
                <td>{{$data->created_by}}</td>
                <td><a href="{{route('purchase.details',$data->id)}}" class="btn button1"><i class="fa fa-eye"></i> View Details</a></td>
                @endforeach
              </tr>
            </tbody>
          </table>
    </div>
@endsection