@extends('admin.admin-navbar')
@section('title')
    Add Supplier - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('admin-content')
    <form action="{{ route("create.supplier") }}" method="POST">
        @csrf
        <div class="box-shadow my-5">
            <h4 class="text-center my-3">Add New Supplier</h4>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @error('suplier_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('contact_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('contact_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('state')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('postal_code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('tax_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('brand')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="row">
                <div class="col-lg-6">
                    <label for="suplier_name" class="col-form-label">Supplier Name<span class="text-danger">*</span></label>
                    <input type="text" name="suplier_name" id="suplier_name" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="contact_name" class="col-form-label">Contact Name<span class="text-danger">*</span></label>
                    <input type="text" name="contact_name" id="contact_name" class="form-control calc-total"
                        required>
                </div>
                <div class="col-lg-6">
                    <label for="contact_number" class="col-form-label">Contact Number<span class="text-danger">*</span></label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control calc-total"
                        required>
                </div>
                <div class="col-lg-6">
                    <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control calc-total"
                        required>
                </div>
                <div class="col-lg-6">
                    <label for="address" class="col-form-label">Address<span class="text-danger">*</span></label>
                    <input type="text" name="address" id="address" class="form-control calc-total">
                </div>
                <div class="col-lg-6">
                    <label for="city" class="col-form-label">City<span class="text-danger">*</span></label>
                    <input type="text" name="city" id="city" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="state" class="col-form-label">State<span class="text-danger">*</span></label>
                    <input type="text" name="state" id="state" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="country" class="col-form-label">Country<span class="text-danger">*</span></label>
                    <input type="text" name="country" id="country" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="postal_code" class="col-form-label">Postal Code<span class="text-danger">*</span></label>
                    <input type="tel" step="any" name="postal_code" id="postal_code" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="tax_id" class="col-form-label">Tax Id<span class="text-danger">*</span></label>
                    <input type="text" step="any" name="tax_id" id="tax_id" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="brand" class="col-form-label">Brand (Name of Company)<span class="text-danger">*</span></label>
                    <input type="text" name="brand" id="brand" class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <select name="status" id="status">Status</select>
                    <option value="">---------- Select Status ----------</option>
                    <option value="1">Active</option>
                    <option value="0">Close Supplier</option>
                </div>
                <div class="col-12">
                    <label for="desc" class="col-form-label">Description</label>
                    <textarea name="description" id="desc" class="form-control"></textarea>
                </div>
                <div class="col-12 my-4">
                    <input type="submit" value="Save Product" title="Save Product" class="button1">
                </div>
            </div>
        </div>
    </form>
@endsection
