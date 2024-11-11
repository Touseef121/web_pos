@extends('admin.admin-navbar')
@section('title')
    Add Product - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('admin-content')
@foreach ($supliers as $data)
    <form action="{{ route('save.supplier',$data->id) }}" method="POST">
        @csrf
        <div class="box-shadow my-5">
            <h4 class="text-center my-3">Edit Product details</h4>
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
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('tax_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('postal_code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('state')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="row">
                    
                <div class="col-lg-6">
                    <label for="suplier_name" class="col-form-label">Supplier Name<span class="text-danger">*</span></label>
                    <input type="text" min="0" name="suplier_name" value="{{$data->suplier_name}}" id="suplier_name"
                        class="form-control calc-total" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="contact_name" class="col-form-label">Contact Name<span class="text-danger">*</span></label>
                    <input type="text" min="0" name="contact_name" id="contact_name" value="{{$data->contact_name}}"  class="form-control calc-total"
                        required>
                </div>
                <div class="col-lg-6">
                    <label for="contact_number" class="col-form-label">Contact Number<span class="text-danger">*</span></label>
                    <input type="text" min="0" name="contact_number" value="{{$data->contact_number}}"  id="contact_number" class="form-control calc-total">
                </div>
                <div class="col-lg-6">
                    <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                    <input type="text" step="any" min="0" name="email" id="email" value="{{$data->email}}"  class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="address" class="col-form-label">Address<span class="text-danger">*</span></label>
                    <input type="text" step="any" value="{{$data->address}}" name="address" id="address"
                    class="form-control calc-total" required>
                </div>
                <div class="col-lg-6">
                    <label for="city" class="col-form-label">City <span class="text-danger">*</span></label>
                    <input type="text" min="0" name="city" value="{{$data->city}}"  id="city" class="form-control calc-total"
                        value="18" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="postal_code" class="col-form-label">Postal Code </label>
                        <input type="text" name="postal_code" value="{{$data->postal_code}}"  id="postal_code" class="form-control" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="tax_id" class="col-form-label">Tax Id </label>
                        <input type="text" name="tax_id" value="{{$data->tax_id}}"  id="tax_id" class="form-control">
                    </div>
                    <div class="col-12 my-4">
                    <input type="submit" value="Save Product" title="Save Product" class="button1">
                </div>
                @endforeach
            </div>
        </div>
    </form>
@endsection
