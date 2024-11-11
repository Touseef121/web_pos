@extends('admin.admin-navbar')
@section('title')
    Create User - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('content')
    <div class="container profile-container">
        <form class="profile-form" method="POST" action="{{route('save.user')}}">
            @csrf
            <h3 class="mb-3 text-center">Create User Profile</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-danger">{{ session('error') }}</div>
            @endif
            @error('user_name')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="user_name">User Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" name="role" id="role">
                    <option selected>Select Role</option>
                    <option value="manager">Manager</option>
                    <option value="cashier">Cashier</option>
                    <option value="data-entry">Data Entry</option>
                  </select>
            </div>
            <button type="submit" class="btn button1">Update Info</button>
        </form>
    </div>
@endsection
