@extends('admin.admin-navbar')

@section('title')
    Purchases - POS
@endsection

@section('admin-content')
<style>
    .search-box{
      display: flex;
      justify-content: right;
    }

    .input-field{
      display: inline;

    }
</style>
    <div class="box-shadow">
        <h2 class="text-center my-3">All Purchases</h2>
        <div class="search-box">
          <form action="{{ route('purchases.search') }}" method="GET">
            <label for="search">Search by Date:</label>
            <div class="form-inline">
                <input type="date" id="search" name="search" class="form-control" value="{{ request('search') }}">
                <button type="submit" name="searchButton" id="search-id" class="btn button1 ml-2">Search</button>
            </div>
        </form>
        
        </div>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">S. no</th>
                <th scope="col">Brand</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Created By</th>
                <th scope="col">Total Price</th>
                <th scope="col">View Details</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $dat)
              <tr>
                <th scope="row">{{$dat->id}}</th>
                <td>{{$dat->brand}}</td>
                <td>{{$dat->category}}</td>
                <td>{{$dat->created_date}}</td>
                <td>{{$dat->created_by}}</td>
                <td>{{$dat->total_cost}}</td>
                <td><a href="{{route('purchase.details',$dat->id)}}" class="btn button1"><i class="fa fa-eye"></i> View Details</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
          <div style="display: flex; justify-content:right;">
            <a href="{{route('admin.index')}}" class="btn button1"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
    </div>


    <script>
     $(document).ready(function () {
    $('#search-btn').click(function () {
        let searchDate = $('#search').val();

        if (!searchDate) {
            alert('Please select a date.');
            return;
        }

        $.ajax({
            url: "{{ route('purchases.search') }}",
            type: "GET",
            data: { search: searchDate },
            success: function (response) {
                let tbody = $('#purchases-table-body');
                tbody.empty(); // Clear current table data

                if (response.data.length > 0) {
                    response.data.forEach(function (item) {
                        tbody.append(`
                            <tr>
                                <th scope="row">${item.id}</th>
                                <td>${item.brand}</td>
                                <td>${item.category}</td>
                                <td>${item.created_date}</td>
                                <td>${item.created_by}</td>
                                <td>${item.total_cost}</td>
                                <td><a href="/purchase/details/${item.id}" class="btn button1"><i class="fa fa-eye"></i> View Details</a></td>
                            </tr>
                        `);
                    });
                } else {
                    tbody.append('<tr><td colspan="7" class="text-center">No records found for the selected date.</td></tr>');
                }
            },
            error: function (xhr) {
                alert(xhr.responseJSON.error || 'An error occurred.');
            }
        });
    });
});

  </script>  
@endsection