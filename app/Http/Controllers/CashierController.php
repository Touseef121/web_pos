<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CashierController extends Controller
{
    public function index(){
        $todayDate = date('Y-m-d');
        $products = Product::all();
        $order_id = Sale::where('date',$todayDate)->orderBy('order_id', 'DESC')->value('order_id');
        // dd($order_id);
        $next_order_id = $order_id + 1;
        return view('cashier.index', compact('todayDate', 'next_order_id', 'products'));
        // $sale_id = SaleItem::with('sale')->where('sale_id',1)->get();
        // dd($sale_id);
    }

    public function getProducts(Request $request)
{
    $products = Product::select('id', 'product_name', 'barcode')->where('product_name', 'like', '%' . $request->term . '%')->get();

    return response()->json($products);
}


public function getProductByBarcode($barcode)
{
    $product = Product::where('barcode', $barcode)->first();

    if ($product) {
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ]);
    }
}

public function fetchProduct(Request $request)
{
    $barcode = $request->input('barcode');
    $quantity = $request->input('quantity'); // Default to 1 if quantity is not provided

    $checkStock = Inventory::where('barcode', $barcode)->value('purchased_units');
    $product = Product::where('barcode', $barcode)->first();
    $price = Inventory::where('barcode', $barcode)->value('per_unit_price');
    // dd($quantity);
    if ($product) {
        if ($checkStock >= $quantity && $checkStock > 0) {
            return response()->json([
                'success' => true,
                'product' => $product,
                'price' => $price
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Stock Not Available for this Product'
            ]);
        }
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ]);
    }
}

public function calculateTotal(Request $request)
{
    $products = $request->input('products');
    $total = 0;

    foreach ($products as $item) {
        $product = Product::find($item['product_id']);
        $total += $product->price * $item['quantity'];
    }

    return response()->json(['total' => $total]);
}


public function savePdfOrder(Request $request)
{
    $products = $request->input('products');
    $orderId = $request->input('order_id');

    $pdf = PDF::loadView('cashier.pdf-template', compact('products', 'orderId'));
    $filePath = storage_path('app/public/orders/order_'.$orderId.'.pdf');
    $pdf->save($filePath);

    // Return the PDF URL for download
    return response()->json([
        'success' => true,
        'pdf_url' => asset('storage/orders/order_'.$orderId.'.pdf')
    ]);
}

public function printOrder($id)
{
    $order = SaleItem::where('sale_id',$id)->get();
    $orderId = SaleItem::where('sale_id',$id)->value('sale_id');
    $todayDate = date('d-M-Y ');
    date_default_timezone_set('Asia/Karachi');
    $time = date('h:i a');
    $loggedInCashier = Auth::user()->user_name;
    return view('cashier.print-template', compact('order', 'todayDate', 'time', 'orderId', 'loggedInCashier'));
}


}

