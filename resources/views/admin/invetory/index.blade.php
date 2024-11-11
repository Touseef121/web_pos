@extends('admin.admin-navbar')

@section('title')
    Inventory - POS
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
                    <th scope="col">Product</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Suplier</th>
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
                    { data: 'sku' },
                    { data: 'barcode' },
                    { data: 'description' },
                    { data: 'purchase_cost' },
                    { data: 'discount' },
                    { data: 'tax' },
                    { data: 'selling_price' },
                    { data: 'stock' },
                    { data: 'suplier_id' },
                    { data: 'expiry_date' },
                    { data: 'status' },
                ]
            });
        });
    </script>
@endsection
