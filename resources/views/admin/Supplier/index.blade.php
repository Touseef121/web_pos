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
                <a href="{{route('add.supplier')}}"  class="button1 btn btn-lg"><i class="fa-solid fa-plus"></i></a>
            </div>
            
            <table class="table mt-3" id="supplier-table">
                <thead class="thead text-light"style="background-color: black;">
                  <tr>
                    <th scope="col">S no.</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Contact Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Postal Code</th>
                    <th scope="col">Tax ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
              </table>
        </div>
    </div>

    
    
    <script type="text/javascript">
        $(function () {
            // Initialize the DataTable
            $('#supplier-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('all.suplier') }}",
                columns: [
                    { data: 'id' },
                    { data: 'suplier_name' },
                    { data: 'contact_name' },
                    { data: 'contact_number' },
                    { data: 'email' },
                    { data: 'address' },
                    { data: 'city' },
                    { data: 'state' },
                    { data: 'postal_code' },
                    { data: 'tax_id' },
                    { data: 'status' },
                    { data: null,
                      orderable: false,
                      searchable: false,
                      render: function(data, type, row) {
                        // Create an "Edit" button with the product's ID
                        return `<a class="button1" href="/edit-supplier/${row.id}"><i class="fa fa-pencil"></i></a>`;
                    }
                    },
                ]
            });
        });
    </script>
@endsection
