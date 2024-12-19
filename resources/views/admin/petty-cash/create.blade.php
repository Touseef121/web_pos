@extends('admin.admin-navbar')

@section('title')
    Petty Cash - POS
@endsection

@section('admin-content')
<style>
    .container{
        height: 70vh;
        overflow: scroll;
    }
    .text{
        position: sticky;
        top: 0;
        background-color: white;
        border: 2px solid black;
    }
</style>
<div class="box-shadow">
    <div class="container">
        <h4 class="text-center text">Add Petty Cash</h4>
            @session('status')
            <div class="alert alert-success">{{session('status')}}</div>
            @endsession
        @error('cashier_id')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_10')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_20')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_50')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_100')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_500')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_1000')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('rs_5000')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        
        <form action="{{ route('petty-cash.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cashier_id">Select Cashier:</label>
                <select name="cashier_id" class="form-control">
                    <option value="">Select Cashier</option>
                    @foreach($cashiers as $cashier)
                        <option value="{{ $cashier->id }}">{{$cashier->id}} - {{ $cashier->user_name }}</option>
                    @endforeach
                </select>
            </div>
            @foreach ([10, 20, 50, 100, 500, 1000, 5000] as $denomination)
                <div class="form-group">
                    <label class="col-form-label">Rs {{ $denomination }}:</label>
                    <input type="number" name="rs_{{ $denomination }}" id="rs-{{$denomination}}" class="form-control cal" min="0" value="0">                
                </div>
            @endforeach
                    <div class="form-group">
                        <label class="col-form-label">Total Amount</label>
                        <input type="number" name="total_amount" id="total-amount" class="form-control cal" min="0" value="0">
                    </div>
            <button type="submit" class="btn btn-primary">Add Petty Cash</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
    $('.cal').on('change', function () {
        // Parse input values as integers (default to 0 if empty or invalid)
        let rs_10 = parseInt($('#rs-10').val()) || 0;
        let rs_20 = parseInt($('#rs-20').val()) || 0;
        let rs_50 = parseInt($('#rs-50').val()) || 0;
        let rs_100 = parseInt($('#rs-100').val()) || 0;
        let rs_500 = parseInt($('#rs-500').val()) || 0;
        let rs_1000 = parseInt($('#rs-1000').val()) || 0;
        let rs_5000 = parseInt($('#rs-5000').val()) || 0;

        // Calculate the total for each denomination
        let total_rs_10 = rs_10 * 10;
        let total_rs_20 = rs_20 * 20;
        let total_rs_50 = rs_50 * 50;
        let total_rs_100 = rs_100 * 100;
        let total_rs_500 = rs_500 * 500;
        let total_rs_1000 = rs_1000 * 1000;
        let total_rs_5000 = rs_5000 * 5000;

        // Calculate the grand total
        let grand_total = 
            total_rs_10 + 
            total_rs_20 + 
            total_rs_50 + 
            total_rs_100 + 
            total_rs_500 + 
            total_rs_1000 + 
            total_rs_5000;

        // Update the total amount field
        $('#total-amount').val(grand_total);
    });
});

</script>
@endsection
