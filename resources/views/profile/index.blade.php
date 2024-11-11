@extends('layout')

@section('title')
    Profile Page - POS
@endsection


@section('content')
    <div class="container profile-container">
        <form class="profile-form"  action="{{route('profile.edit')}}">
            @csrf
            <h3 class="mb-3 text-center">User Profile</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-danger">{{ session('error') }}</div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">User Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  value="{{ $user->user_name }}" readonly
                    disabled aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}" readonly
                    disabled aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Role</label>
                <input type="text" readonly disabled class="form-control" value="{{ $user->role }}"
                    id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Update Info</button>
        </form>
    </div>
@endsection
