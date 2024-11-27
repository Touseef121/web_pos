@extends('admin.admin-navbar')

@section('title')
    Add Purchase - POS
@endsection

@section('admin-content')
@csrf
<div class="box-shadow my-2">
    <h4 class="text-center my-3">Add Purchase</h4>
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @error('product_id')
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
                    @error('purchased_units')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                @error('purchase_cost')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('tax')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('discount')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('per_unit_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('expiry_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('created_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('total_cost')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <form method="POST" action="{{route('update.product',)}}">
                    @csrf
                <div class="row">
                    <div class="col-log-12">
                    <input type="hidden" id="product_id" name="product_id">
                    </div>
                    <div class="col-lg-12">
                        <label for="date" class="col-form-label">Date Today<span class="text-danger">*</span></label>
                        <input type="date" value="<?php echo date('Y-m-d');?>" name="created_date" id="date" class="form-control calc-total">
                    </div>
                    <form>
                        <div class="col-lg-6">
                            <label for="barcode-input" class="col-form-label">Barcode<span class="text-danger">*</span></label>
                            <input type="text" min="0" name="barcode" max="1" id="barcode-input" class="form-control calc-total" required>
                        </div>
                    </form>
                    <div class="col-lg-6">
                        <label for="product-name" class="col-form-label">Product Name<span class="text-danger">*</span></label>
                        <input type="text" min="0" name="product_name" readonly disabled id="product-name"
                            class="form-control calc-total" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="brand" class="col-form-label">Product Category <span class="text-danger">*</span></label>
                        <input type="text" min="0" name="category" readonly id="pd-category" class="form-control calc-total" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="brand" class="col-form-label">Product Brand <span class="text-danger">*</span></label>
                        <input type="text" min="0" name="brand" readonly id="pd-brand" class="form-control calc-total" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="purchased-units" class="col-form-label">Purchased Units<span class="text-danger">*</span></label>
                        <input type="number" min="0" name="purchased_units" id="purchased-units" class="form-control calc-total"
                            required>
                    </div>
                    <div class="col-lg-6">
                        <label for="purchase-price" class="col-form-label">Purchased Price<span
                                class="text-danger">*</span></label>
                        <input type="number" step="any" min="0" name="purchase_cost" id="purchase-price"
                            class="form-control calc-total" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="gst" class="col-form-label">GST (%) <span class="text-danger">*</span></label>
                        <input type="number" min="0" name="tax" value="18" id="gst" class="form-control calc-total"
                            value="18" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="discount" class="col-form-label">Discount (%)<span class="text-danger">*</span></label>
                        <input type="number" step="any" max="100" name="discount" id="discount"
                            class="form-control calc-total">
                    </div>
                    <div class="col-lg-6">
                        <label for="price-unit" class="col-form-label">Price (Per Unit)</label>
                        <input type="number" name="per_unit_price" id="price-unit" class="form-control" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="selling-price" class="col-form-label">Price (Total)</label>
                        <input type="number" name="total_cost" id="selling-price" class="form-control" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="exp_date" class="col-form-label">Expiry Date<span class="text-danger">*</span></label>
                        <input type="date" name="expiry_date" id="exp-date" class="form-control calc-total" required>
                    </div>
                    <div class="col-12 my-4">
                        <button  class="button1">Add Purchase</button>
                    </div>
                </div>
            </div>
        </form>
    
        
<script type="text/javascript">

$(".calc-total").on("keyup", function(e) {
    let gst = Number($("#gst").val());
let quantity = Number($("#purchased-units").val());
let price = Number($("#purchase-price").val());
let discount = Number($("#discount").val()); 

let gst_item = price * quantity * (gst / 100);

let purchase_total = (price * quantity) + gst_item;

let perUnitPrice = purchase_total / quantity;

if (discount > 0) {
    let discount_amount = purchase_total * (discount / 100);

    let totalPriceAfterDiscount = purchase_total - discount_amount;

    let discountedPerUnit = totalPriceAfterDiscount / quantity;

    $("#selling-price").val(totalPriceAfterDiscount.toFixed(2));
    $("#price-unit").val(discountedPerUnit.toFixed(2));
} else {
    $("#selling-price").val(purchase_total.toFixed(2));
    $("#price-unit").val(perUnitPrice.toFixed(2));
}

    
            });

            $(document).ready(function() {
            $('#barcode-input').on('keyup', function(j) {
            var barcode = $(this).val();
            // Make an AJAX request to fetch product data
            $.ajax({
                url: '/product/barcode/' + barcode,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#product-name').val(response.data.product_name);
                        $('#product_id').val(response.data.id);
                        $('#pd-brand').val(response.data.brand);
                        $('#exp-date').val(response.data.expiry_date);
                        $('#pd-category').val(response.data.category);
                    } else {
                        "Product Not Found";
                    }
                }
            });
        });
    });
    
</script>

@endsection