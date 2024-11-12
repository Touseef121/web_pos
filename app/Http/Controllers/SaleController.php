<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function saveOrder(Request $request)
    {
        if ($request->payment_method == 'card') {
            $request->validate([
                'transaction_id' => 'string',
                'payment_method' => 'string',
            ]);
        }
        // dd($request->payment_method);
        $request->validate([
            'order_id' => 'required',
            'products' => 'required|array',
            'products.*.name' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'date' => 'required|date'  
        ]);
    
        DB::beginTransaction(); 
    
        try {
            $sale = Sale::create([
                'order_id' => $request->order_id,
                'date' => $request->date, 
                'cashier_id' => Auth::id(),
                'total_price' => collect($request->products)->sum(function ($product) {
                    return $product['price'] * $product['quantity'];
                }),
                'transaction_id' => $request->payment_method == 'card' ? $request->transaction_id : "Cash payment",
                'payment_method' => $request->payment_method == "card" ? "Card Payment" : "Cash payment",
            ]);
    
            foreach ($request->products as $product) {

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_name' => $product['name'],
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'total_price' => $product['price'] * $product['quantity'],
                ]);
    
                
                $inventoryItem = Inventory::where('product_id', $product['product_id'])->first(); 

                
                if ($inventoryItem) {
                    $productName = Product::where('id',$product['product_id'])->value('product_name');
                        $inventoryItem->purchased_units -= $product['quantity'];
                    
                        if ($inventoryItem->purchased_units < 0) {
                            return response()->json(['error' => true, 'message' =>  'Not enough stock for the product. ' . 'Name: "' . $productName . '"'], 400);
                        }
                
    
                    $inventoryItem->save(); 
                }
            }
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Order saved successfully!']);
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json(['success' => false, 'message' => 'Failed to save order: ' . $e->getMessage()], 500);
        }
    }
    




        public function showTodayOrders(Request $request)
        {
            $date = $request->input('date') ?? now()->toDateString();
            $orders = Sale::with('cashier')->whereDate('date', $date)->get();
            // dd($orders);
            return view('cashier.today-order', compact('orders', 'date'));
        }

        public function viewOrderDetails($orderId)
        {
            $order = Sale::with('products')->with('cashier')->find($orderId); 
            $grandTotal = Sale::find($orderId);
            // dd($grandTotal->total_price);
            if (!$order) {
                abort(404, 'Order not found');
            }

            return view('cashier.details', compact('order', 'grandTotal'));
        }

        public function allSales(){
            return view('admin.Sales.sales');
        }
        public function totalSales(Request $request)
        {
            if ($request->ajax()) {
                $sales = Sale::with(['products', 'cashier'])
                    ->select(['id', 'order_id', 'cashier_id', 'date', 'payment_method', 'transaction_id'])
                    ->get();
                
                return DataTables::of($sales)
                    ->addColumn('cashier_name', function($sale) {
                        return $sale->cashier ? $sale->cashier->user_name : 'N/A';
                    })
                    ->addColumn('product_name', function($sale) {
                        return $sale->products->pluck('product_name')->join(', ');
                    })
                    ->addColumn('quantity', function($sale) {
                        return $sale->products->pluck('quantity')->join(', ');
                    })
                    ->addColumn('total_price', function($sale) {
                        return $sale->products->pluck('total_price')->join(', ');
                    })
                    ->make(true);
            }
        }


        public function todaySales()
            {
                $today = Carbon::today();

                // Get all cashiers with their sales and calculate total sales amount for each cashier
                $sales = User::with(['sales' => function($query) use ($today) {
                    $query->whereDate('created_at', $today);
                }])
                ->where('role', 'cashier')
                ->get();

                // Calculate the total sales amount for each cashier
                foreach ($sales as $cashier) {
                    $cashier->total_sales_amount = $cashier->sales->sum('total_price');
                }

                return view('admin.Sales.today-sales', compact('sales'));
            }
        
            public function salesByCashier(Request $request, $cashier_id)
                {
                    $date = $request->get('date', Carbon::today()); // Default to today's date if no date is provided

                    // Fetch sales for the given cashier and date
                    $cashier = User::with(['sales' => function($query) use ($date) {
                            $query->whereDate('created_at', $date);
                        }])
                        ->where('id', $cashier_id)
                        ->where('role', 'cashier')
                        ->firstOrFail();

                    // Calculate total sales amount for the selected date
                    $total_sales_amount = $cashier->sales->sum('total_price');

                    // Return JSON data to JavaScript
                    return response()->json([
                        'sales' => $cashier->sales->map(function ($sale) {
                            return [
                                'order_id' => $sale->order_id,
                                'total_price' => $sale->total_price,
                                'payment_method' => $sale->payment_method,
                                'transaction_id' => $sale->transaction_id,
                                'date' => $sale->created_at->format('Y-m-d'),
                            ];
                        }),
                        'total_sales_amount' => $total_sales_amount,
                    ]);
                }



}
