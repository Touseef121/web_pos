@extends('admin.admin-navbar')

@section('title')
    Add Product - POS
@endsection

@section('link')
    {{route('admin.index')}}
@endsection

@section('admin-content')
<style>
    body{
        height: 80% !important;
        overflow: auto !important;
    }
     .table{
            height: 100% !important;
        }
        .box-shadow{
            height: 90% !important;
        }
        thead{
            top: 0;
            position: sticky !important;
        }
</style>
<body>
    

    <div class="box-shadow mt-5">
        <div>
            <h3 class="text-center">Overall Sales</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <div class="table">
            <table class="table mt-3" id="sales-table">
                <thead class="thead text-light" style="background-color: black;">
                    <tr>
                        <th scope="col">S no.</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Cashier Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date (Y-M-D)</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Profit (Per Order)</th>
                    </tr>
                </thead>
            </table>
           </div>
        </div>
    </div>

    
    <script type="text/javascript">
        $(function () {
            $('#sales-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('total.sales') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'cashier_name', name: 'cashier_name' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'date', name: 'date' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'transaction_id', name: 'transaction_id' },
                    { data: 'total_price', name: 'total_price' },
                    { data: 'profit_loss', name: 'profit_loss' },
                ]
            });
        });
    </script>
    
</body>
    @endsection
