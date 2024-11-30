@extends('admin.admin-navbar')
@section('title')
    Create Employee - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('admin-content')
    <div class="container profile-container1">
        <form class="profile-form" enctype="multipart/form-data" method="POST" action="{{ route('save.employee') }}">
            @csrf
            <h3 class="mb-3 text-center">Create Employee</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-danger">{{ session('error') }}</div>
            @endif
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('father_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('id_card_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('phone_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('dob')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('picture')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('joining_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('leaving_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('id_card_picture')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('salary')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                    
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="father_name">Father Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_card">Id Card Number</label>
                        <input type="number" class="form-control" id="id_card" name="id_card_number">
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" class="form-control" id="salary" name="salary">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="salary">Salary Status</label>
                        <select name="salary_status" id="salary" class="form-control">
                            <option value="UnPaid">UnPaid</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="joining">Joining Date</label>
                        <input type="date" class="form-control" id="joining" name="joining_date">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="leaving">Leaving Date</label>
                        <input type="date" class="form-control" id="leaving" name="leaving_date">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="id_card_pic">Id Card Picture</label>
                        <input type="file" class="form-control py-1" id="id_card_pic" name="id_card_picture">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="picture">Picture</label>
                        <input type="file" class="form-control py-1" id="picture" name="picture">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn button1">Create Employee</button>
        </form>
    </div> 
@endsection
