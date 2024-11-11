<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function checkStock(Request $request)
        {
            $barcode = $request->input('barcode');
            $requestedQuantity = $request->input('quantity');

            // Query the inventory table for the available stock
            $product = Inventory::where('barcode', $barcode)->first()->value('purchased_units');
            // dd($product);
            if ($product >= $requestedQuantity) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'available_stock' => $product ?? 0]);
            }
        }
    
}
