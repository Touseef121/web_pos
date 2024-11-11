@extends('data-entry.data-entry-navbar')
@section('link')
    {{route('dataentry.index')}}
@endsection
@section('title')
    Data Entry Dashboard - POS
@endsection
@section('link')
    {{route('dataentry.index')}}
@endsection
@section('content')
    <body>
        <div class="container">
            @if (Session('error'))
            <div class="alert alert-danger my-4">{{Session('error')}}</div>
            @endif
            <h2 class="text-center">Data Entry Dashboard</h2>
        </div>
        
    </body>
@endsection