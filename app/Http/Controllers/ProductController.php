<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('data-entry.index');
    }

    public function fetchProductByBarcode($barcode)
    {
        $product = Product::where('barcode', $barcode)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
    }

    public function purchaseBarcode(){
        
        return view('admin.products.add-purchase');
    }

    public function updateProduct(Request $request){
       $id = $request->product_id;
    
        $extisting_units = Inventory::where('product_id',$id)->value('purchased_units');
        $stock = $request->purchased_units;
        if($extisting_units){
            $sum = $extisting_units + $stock;
            $product = Inventory::where('product_id', $id)->update(['purchased_units' => $sum]);
            return redirect()->route('purchase.barcode')->with('status', 'Purchase added successfully!');
        }else{
            $newProduct =  $request->validate([
            'product_id' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'barcode' => 'required',
            'purchased_units' => 'required',
            'purchase_cost' => 'required',
            'tax' => 'required',
            'discount' => 'numeric',
            'per_unit_price' => 'required',
            'total_cost' => 'required',
            'expiry_date' => 'required',
            'created_date' => 'required',
        ]);
        $product = Inventory::create($newProduct);
    }
        return redirect()->route('purchase.barcode')->with('status', 'Purchase added Successfully');
    }
    
    public function search(Request $request) {
        $search = $request->get('q');
        $products = Product::where('product_name', 'LIKE', "%$search%")->get();
        // dd($products);
        return response()->json($products);
    }
    
    public function getProductDetails(Request $request) {
        $product = Product::with('inventory')->find($request->product_id);
        if ($product) {
            return response()->json(['success' => true, 'product' => $product]);
        } else {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    }
    
}
