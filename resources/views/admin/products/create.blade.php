@extends('admin.admin-navbar')
@section('title')
    Add Product - POS
@endsection

@section('link')
    {{ route('admin.index') }}
@endsection

@section('admin-content')


<form action="{{ route('create.product') }}" method="POST" class="p-5"> 
    @csrf
    <div class="box-shadow my-2">
        <h4 class="text-center my-3">Add A New Product</h4>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @error('product_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('brand')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('barcode')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('expiry_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="row">
            <div class="col-lg-6">
                <label for="product_name" class="col-form-label">Product Name<span class="text-danger">*</span></label>
                <input type="text" min="0" name="product_name" id="product_name"
                    class="form-control calc-total" required>
            </div>
            <div class="col-lg-6">
                <label for="category" class="col-form-label">Product Category <span class="text-danger">*</span></label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Default">Select Category</option>
                    <option value="Food">Food</option>
                    <option value="Beverages">Beverage</option>
                    <option value="FrozenItems">Frozen Items</option>
                    <option value="Grocery">Grocery</option>
                    <option value="Cosmetics">Cosmetics</option>
                    <option value="CookWare">Cook Ware</option>
                    <option value="Toys">Toys</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="barcode" class="col-form-label">Barcode<span class="text-danger">*</span></label>
                <input type="number" min="0" name="barcode" id="barcode" class="form-control calc-total">
            </div>
            <div class="col-lg-6">  
                @foreach ($suplier as $suplier)
                    <label for="brand" class="col-form-label">Product Brand <span
                            class="text-danger">*</span></label>
                    <select name="brand" id="brand" class="form-control" required>
                        <option value="">Select (Brand)</option>
                        <option value="{{ $suplier->brand }}">{{ $suplier->brand }}</option>
                    </select>
            </div>
            <div class="col-lg-6">
                <label for="brand" class="col-form-label">Product Suplier <span class="text-danger">*</span></label>
                <select name="suplier_id" id="brand" class="form-control" required>
                    <option value="">Select Supplier</option>
                    <option value="{{ $suplier->id }}">{{ $suplier->id }} - {{ $suplier->suplier_name }}</option>
                </select>
                @endforeach
            </div>
            <div class="col-lg-6">
                <label for="expiry_date" class="col-form-label">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control">
            </div>
            <div class="col-12 my-4">
                <input type="submit" value="Save Product" title="Save Product" class="button1">
            </div>
        </div>
    </div>
</form>


<script>
    $(".calc-total").on("keyup", function(e) {
        let gst = Number($("#gst").val());
        let quantity = Number($("#quantity").val());
        let price = Number($("#purchase_price").val());
        let discount = Number($("#discount").val());


        let gst_item = price * (gst / 100);
        let purchase_total = (price + gst_item) * quantity;
        let perUnitPrice = purchase_total / quantity;
        if (discount > 0) {
            let discountedPrice = price * (discount / 100)
            let totalPrice = purchase_total - discountedPrice
            let discountedPerUnit = totalPrice / quantity;
            $("#total").val(totalPrice);
            $("#per_unit").val(discountedPerUnit);
        } else {
            $("#total").val(purchase_total);
            $("#per_unit").val(perUnitPrice);
        }

    });
</script>
@endsection
