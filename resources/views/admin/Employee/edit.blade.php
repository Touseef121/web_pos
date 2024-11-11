@extends('admin.admin-navbar')

@section('title')
    Update Employee - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('admin-content')

    <div class="container profile-container1">
        <form class="profile-form" method="POST" action="{{ route('save.edit',$employeeData->id) }}">
            @csrf
            {{-- @foreach ($employeeData as $data) --}}
            <h3 class="mb-3 text-center">Update Employee Info</h3>
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
                @error('joining_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('leaving_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                @error('salary')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" value="{{$employeeData->name}}" id="name" name="name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="father_name">Father Name</label>
                        <input type="text" class="form-control" value="{{$employeeData->father_name}}" id="father_name" name="father_name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control" value="{{$employeeData->phone_number}}" id="phone_number" name="phone_number">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_card">Id Card Number</label>
                        <input type="number" class="form-control" value="{{$employeeData->id_card_number}}" id="id_card" name="id_card_number">
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" value="{{$employeeData->dob}}" id="dob" name="dob">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" class="form-control" value="{{$employeeData->salary}}" id="salary" name="salary">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="salary">Salary Status</label>
                        <select name="salary_status" id="salary" class="form-control">
                            <option value="0">-----  Select an Option  -----</option>
                            <option value="Paid">Paid</option>
                            <option value="UnPaid">Un-Paid</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="joining">Joining Date</label>
                        <input type="date" class="form-control" readonly disabled value="{{$employeeData->joining_date}}" id="joining" name="joining_date">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="leaving">Leaving Date</label>
                        <input type="date" class="form-control" value="{{ $employeeData->leaving_date }}" id="leaving" name="leaving_date">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn button1">Update Employee Info</button>
        </form>
        {{-- @endforeach --}}
    </div> 
@endsection
