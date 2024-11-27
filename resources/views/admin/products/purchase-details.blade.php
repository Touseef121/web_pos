@extends('admin.admin-navbar')

@section('title')
    Purchase Details - POS
@endsection

@section('admin-content')
    <div class="box-shadow">
        {{$details}}
    </div>
@endsection