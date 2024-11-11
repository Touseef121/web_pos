@extends('admin.admin-navbar')
@section('title')
    Add Product - POS
@endsection

@section('link')
    {{route('admin.index')}}
@endsection

@section('admin-content')
    <div class="box-shadow mt-5">
        <div>
            <h3 class="text-center">Products List</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div style="display:flex; justify-content:right">
                <a href="{{route('add.product')}}"  class="button1 btn btn-lg"><i class="fa-solid fa-plus"></i></a>
            </div>
            
              
            <table class="table mt-3" id="product-table">
                <thead class="thead text-light"style="background-color: black;">
                  <tr>
                    <th scope="col">S no.</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
              </table>
        </div>
    </div>

    
    
    <script type="text/javascript">
        $(function () {
            // Initialize the DataTable
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('all.products') }}",
                columns: [
                    { data: 'id' },
                    { data: 'product_name' },
                    { data: 'category' },
                    { data: 'brand' },
                    { data: 'barcode' },
                    { data: 'expiry_date' },
                    { data: null,
                      orderable: false,
                      searchable: false,
                      render: function(data, type, row) {
                        // Create an "Edit" button with the product's ID
                        return `<a class="button1" href="/delete-product/${row.id}"><i class="fa fa-trash"></i></a>`;
                    }
                    },
                ]
            });
        });
    </script>
@endsection