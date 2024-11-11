@extends('manager.manager-navbar')

@section('link')
    {{route('manager.index')}}
@endsection

@section('title')
    Manager Dashboard - POS
@endsection


@section('content')
    <body>
        <div class="container">
            @if (Session('error'))
            <div class="alert alert-danger my-4">{{Session('error')}}</div>
            @endif
            <h2 class="text-center">Manager Dashboard</h2>
        </div>
    </body>
@endsection