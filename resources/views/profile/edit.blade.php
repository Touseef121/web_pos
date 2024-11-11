@extends('layout')

@section('title')
    Profile Page - POS
@endsection


@section('content')
    <div class="container profile-container">
        <form class="profile-form" action="{{route('save.profile',$user)}}" method="POST">
            @csrf
            <h3 class="mb-3 text-center">User Profile</h3>

            {{-- Errors + Validation Errors --}}
            @if (session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
            @endif
            @error('password')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('old_password')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror

            {{-- Form Data --}}

            <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input type="text" class="form-control" name="old_password"
                    id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="text" class="form-control" name="password"
                    id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="text" class="form-control" name="password_confirmation"
                    id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Update Info</button>
        </form>
    </div>
@endsection

