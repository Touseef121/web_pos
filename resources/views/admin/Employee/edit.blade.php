@extends('admin.admin-navbar')

@section('title')
    Update Employee - POS
@endsection

@section('admin-content')
<div class="container profile-container1">
    <form class="profile-form" method="POST" action="{{ route('save.edit', $employeeData->id) }}">
        @csrf
        <h3 class="mb-3 text-center">Update Employee Info</h3>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <!-- General Information -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" value="{{ $employeeData->name }}" id="name" name="name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="father_name">Father Name</label>
                    <input type="text" class="form-control" value="{{ $employeeData->father_name }}" id="father_name" name="father_name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="number" class="form-control" value="{{ $employeeData->phone_number }}" id="phone_number" name="phone_number">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="id_card">ID Card Number</label>
                    <input type="number" class="form-control" value="{{ $employeeData->id_card_number }}" id="id_card" name="id_card_number">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" value="{{ $employeeData->dob }}" id="dob" name="dob">
                </div>
            </div>

            <!-- Salary Information -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" value="{{ $employeeData->salary }}" id="salary" name="salary">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="salary_status">Salary Status</label>
                    <select name="salary_status" id="salary_status" class="form-control">
                        <option value="Paid" {{ $employeeData->salary_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Unpaid" {{ $employeeData->salary_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>
            </div>

            <!-- Dates -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="joining">Joining Date</label>
                    <input type="date" class="form-control" readonly value="{{ $employeeData->joining_date }}" id="joining" name="joining_date">
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
</div>
@endsection
