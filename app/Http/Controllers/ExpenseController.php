<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function createExpense(){
        $date = date('Y-m-d');
        $user = Auth::user()->user_name;
        return view('admin.Expenses.create-expense', compact('date', 'user'));
    }

    public function saveExpense(Request $request){
        if($request->expense_type === "other"){
            $data = $request->validate([
                'expense_name' => 'required',
                'description' => 'required',
                'expense_type' => 'required',
                'expense_amount' => 'required',
                'created_date' => 'required',
                'created_by_user' => 'required'
            ]);
            $expense = Expense::create($data);
            return redirect()->route('create.expense')->with('status', 'Expense Created Successfully');

        } elseif($request->expense_type === "salary"){
            $data = $request->validate([
                'employee_name' => 'required',
                'expense_type' => 'required',
                'total_salary' => 'required',
                'per_day_salary' => 'required',
                'working_days' => 'required',
                'monthly_days' => 'required',
                'salary_expense' => 'required',
                'created_date' => 'required',
                'created_by_user' => 'required'
            ]);
            $expense = Expense::create($data);
            return redirect()->route('create.expense')->with('status', 'Expense Created Successfully');
        } else{
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }    

    public function indexExpenses(){
        $expenses = Expense::all();
        return view('admin.Expenses.index-expenses', compact('expenses'));
    }

    public function getExpenses(Request $request) {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
    
        $expenses = Expense::where('expense_type', 'salary')
                            ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
                                return $query->whereBetween('created_date', [$fromDate, $toDate]);
                            })
                            ->get();
    
        // Ensure all values are numeric before summing
        $totalAmount = $expenses->sum(function ($expense) {
            return floatval($expense->salary_expense ?? 0);
        });
    
        return response()->json([
            'data' => $expenses,
            'totalAmount' => $totalAmount
        ]);
    }
    
    public function getOtherExpenses(Request $request) {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
    
        $expenses = Expense::where('expense_type', 'other')
                            ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
                                return $query->whereBetween('created_date', [$fromDate, $toDate]);
                            })
                            ->get();
    
        // Ensure all values are numeric before summing
        $totalAmount = $expenses->sum(function ($expense) {
            return floatval($expense->expense_amount ?? 0);
        });
    
        return response()->json([
            'otherData' => $expenses,
            'totalAmount' => $totalAmount
        ]);
    }
    
    


}
