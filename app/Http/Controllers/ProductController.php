<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\PurchaseRecord;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user()->user_name;
        return view('admin.products.add-purchase', compact('user'));
    }

    public function updateProduct(Request $request){
         $id = $request->product_id;
         $extisting_units = Inventory::where('product_id',$id)->value('purchased_units');
         $stock = $request->purchased_units;
         if($extisting_units){
             $sum = $extisting_units + $stock;
             $purchase_cost = $request->purchase_cost;
             $tax = $request->tax;
             $discount = $request->discount;
             $price_with_gst = $request->price_with_gst;
             $per_unit_price = $request->per_unit_price;
             $total_cost = $request->total_cost;
             $created_by = Auth::user()->user_name;
             $created_date = date('Y-m-d');
            //  dd(1);
             $product = Inventory::where('product_id', $id)->update(['purchased_units' => $sum, 'purchase_cost' => $purchase_cost, 'tax' => $tax, 'discount' => $discount, 'price_with_gst' => $price_with_gst,'per_unit_price' => $per_unit_price, 'total_cost' => $total_cost, 'created_by' => $created_by, 'created_date' => $created_date]);
             
             // dd($data);
             PurchaseRecord::create(['product_id' => $request->product_id ,'category' => $request->category, 'brand' => $request->brand, 'barcode' => $request->barcode,'purchased_units' => $request->purchased_units, 'purchase_cost' => $request->purchase_cost, 'tax' => $request->tax, 'discount' => $request->discount, 'price_with_gst' => $price_with_gst, 'per_unit_price' => $request->per_unit_price, 'total_cost' => $request->total_cost, 'created_by' => $created_by, 'created_date' => $created_date, 'expiry_date' => $request->expiry_date]);
             return redirect()->route('purchase.barcode')->with('status', 'Purchase added successfully!');
            }else{
                $created_by = Auth::user()->user_name;
                $created_date = date('Y-m-d');
                $newProduct =  $request->validate([
                    'product_id' => 'required',
                    'category' => 'required',
                    'brand' => 'required',
                    'barcode' => 'required',
                    'purchased_units' => 'required',
                    'purchase_cost' => 'required',
                    'tax' => 'required',
                    'discount' => 'numeric',
                    'price_with_gst' => 'required',
                    'per_unit_price' => 'required',
                    'total_cost' => 'required',
                    'created_by' => 'required',
                    'expiry_date' => 'required',
                ]);
                // dd(2);
                $product =  Inventory::create(['product_id' => $request->product_id ,'category' => $request->category, 'brand' => $request->brand, 'barcode' => $request->barcode,'purchased_units' => $request->purchased_units, 'purchase_cost' => $request->purchase_cost, 'tax' => $request->tax, 'discount' => $request->discount, 'per_unit_price' => $request->per_unit_price, 'total_cost' => $request->total_cost, 'created_by' => $created_by, 'created_date' => $created_date, 'expiry_date' => $request->expiry_date]);
            $created_by = Auth::user()->user_name;
            PurchaseRecord::create(['product_id' => $request->product_id ,'category' => $request->category, 'brand' => $request->brand, 'barcode' => $request->barcode,'purchased_units' => $request->purchased_units, 'purchase_cost' => $request->purchase_cost, 'tax' => $request->tax, 'discount' => $request->discount, 'per_unit_price' => $request->per_unit_price, 'total_cost' => $request->total_cost, 'created_by' => $created_by, 'created_date' => $created_date, 'expiry_date' => $request->expiry_date]);
     }
    //  dd(4);
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
    

    public function purchasesIndex(){
        $data = PurchaseRecord::paginate(10);
        // dd($data);
        return view('admin.products.purchase-index', compact('data'));
    }

    public function purchaseDetails(String $id){
        $details = PurchaseRecord::where('id',$id)->with('product')->get();
        // return $details;
        return view('admin.products.purchase-details',compact('details'));
    }

    public function searchrec(Request $request)
{
    $searchDate = $request->input('search');
    $data = PurchaseRecord::whereDate('created_date', $searchDate)->paginate(10);
    
    return view('admin.products.purchase-index', compact('data'));
}
}
