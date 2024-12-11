<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use Illuminate\Http\Request;
use PDF;

class ProfitController extends Controller
{
    public function profitIndex(){
        return view('admin.profits.profit-index');
    }


    public function fetchProfitLoss(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    if (!$from || !$to) {
        return response()->json(['error' => 'Invalid date range'], 400);
    }

    $data = SaleItem::whereBetween('created_at', [$from, $to])->get();

    return response()->json([
        'data' => $data
    ]);
}

public function downloadProfitLossReport(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    if (!$from || !$to) {
        return response()->json(['error' => 'Invalid date range'], 400);
    }

    // Fetch the data within the date range
    $data = SaleItem::whereBetween('created_at', [$from, $to])->get();

    // Generate PDF
    $pdf = PDF::loadView('admin.profits.profit-loss-report', compact('data', 'from', 'to'));

    // Download PDF
    return $pdf->download('profit_loss_report_' . $from . '_to_' . $to . '.pdf');
}
}