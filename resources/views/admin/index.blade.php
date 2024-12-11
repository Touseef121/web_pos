@extends('admin.admin-navbar')

@section('title')
    Admin - Dashboard
@endsection

@section('admin-content')
<style>
    .aTags:hover{
        text-decoration: none
    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>
    
    <div class="row">
        

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a href="{{route('all.sales')}}" class="aTags">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-l font-weight-bold text-success text-uppercase mb-1">
                                    Sales (Overall Sales)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">PKR: {{number_format($overallSales,0)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="{{route('all.sales')}}" class="aTags">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-l font-weight-bold text-primary text-uppercase mb-1">
                                    Sales ( Today )</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">PKR: {{ number_format($totalSales, 0) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="{{route("profit.index")}}" class="aTags">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-l font-weight-bold text-primary text-uppercase mb-1">
                                    Profit/loss ( Overall )</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">PKR: {{ number_format($profit, 0) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <a href="{{route('index.product')}}" class="aTags">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-l font-weight-bold text-primary text-uppercase mb-1">
                                    Total Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProducts}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bag-shopping fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a href="{{route('view.employee')}}" class="aTags">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-l font-weight-bold text-primary text-uppercase mb-1">
                                    Employees Working (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEmployee }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>  
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a href="{{route('view.employee')}}" class="aTags">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-l font-weight-bold text-primary text-uppercase mb-1">
                                    Employees ( Total Salaries )</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">PKR: {{ number_format($total_salaries, 0) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        
    </div>

</div>


{{-- <footer class="sticky-footer bg-dark text-light pageBottom">
    <div class="container my-auto">
        <div class=" text-center">
            <span>Copyright &copy; POS</span>
        </div>
    </div>
</footer> --}}

@endsection