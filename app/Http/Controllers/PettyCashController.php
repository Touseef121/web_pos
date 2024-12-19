<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PettyCash;
use Illuminate\Http\Request;

class PettyCashController extends Controller
{
    public function create()
    {
        $cashiers = User::where('role', 'cashier')->get();
        if ($cashiers->isEmpty()) {
            return redirect()->back()->withErrors('No cashiers found.');
        }
        return view('admin.petty-cash.create', compact('cashiers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cashier_id' => 'required|exists:users,id',
            'rs_10' => 'numeric|min:0',
            'rs_20' => 'numeric|min:0',
            'rs_50' => 'numeric|min:0',
            'rs_100' => 'numeric|min:0',
            'rs_500' => 'numeric|min:0',
            'rs_1000' => 'numeric|min:0',
            'rs_5000' => 'numeric|min:0',
            'total_amount' => 'numeric|min:0',
        ]);

        PettyCash::create([
            'cashier_id' => $validated['cashier_id'],
            'rs_10' => $validated['rs_10'],
            'rs_20' => $validated['rs_20'],
            'rs_50' => $validated['rs_50'],
            'rs_100' => $validated['rs_100'],
            'rs_500' => $validated['rs_500'],
            'rs_1000' => $validated['rs_1000'],
            'rs_5000' => $validated['rs_5000'],
            'total_amount' => $validated['total_amount'],
        ]);
        User::where('id', $validated['cashier_id'])->update(['has_petty_cash_notification' => true]);
        return redirect()->back()->with('status', 'Petty cash added successfully.');
    }

    public function showPopup()
    {


            $today = now()->startOfDay();
            $pettyCash = PettyCash::where('cashier_id', auth()->id())
                ->where(function ($query) use ($today) {
                    $query->whereNull('popup_shown_at')
                        ->orWhere('popup_shown_at', '<', $today);
                })
                    ->latest()
                    ->first();

                if ($pettyCash) {
                    $pettyCash->update(['popup_shown_at' => now()]);
                    return response()->json([
                        'showPopup' => true,
                        'data' => $pettyCash,
                    ]);
    }
    }

    public function markNotificationRead()
    {
        $pettyCash = PettyCash::where('cashier_id', auth()->id())
            ->latest()
            ->first();
    
        if ($pettyCash) {
            $pettyCash->update(['popup_shown_at' => now()]);
            return response()->json(['status' => 'success']);
        }
    
        return response()->json(['status' => 'error'], 404);
    }

}
