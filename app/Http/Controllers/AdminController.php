<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Suplier;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

        // Private function for barcode generation
        
        private function generateNextBarcode()
    {
        $lastProductWithoutBarcode = Product::whereNull('barcode')->orWhereRaw('barcode REGEXP "^[0-9]+$"')->orderBy('barcode', 'desc')->first();

        if ($lastProductWithoutBarcode) {
            $nextBarcode = intval($lastProductWithoutBarcode->barcode) + 1;
        } else {
            $nextBarcode = 1;
        }

        return (string) $nextBarcode;
    }

    public function index(){
        $totalProducts = Product::count();
        $totalEmployee = Employee::count();
        $unPaid = "UnPaid";
        $paid = "Paid";
        $total_salaries = Employee::sum('salary');
        $pending_salaries = Employee::where('salary_status',$unPaid)->sum('salary');
        $paid_salaries = Employee::where('salary_status',$paid)->sum('salary');
        $dateToday = date('Y-m-d');
        $totalSales = Sale::where('date',$dateToday)->sum('total_price');
        return view('admin.index', compact('totalProducts', 'totalEmployee', 'totalSales', 'pending_salaries', 'total_salaries', 'paid_salaries'));
    }

    public function profileIndex(){
        if(Auth::user()){
            $user = Auth::User();
            return view('profile.index', compact('user'));
        }
    }
    public function profileEdit(){
        if(Auth::user()){
            $user = Auth::id();
            return view('profile.edit', compact('user'));
        }
    }

    public function saveProfile(Request $request, String $id){
        $userOldPassword = $request->validate(
            [
                'old_password' => 'required'
            ]
        );
        $userPassword = Auth::user()->password;
        if(Hash::check($request->old_password, $userPassword)){
            $passwordValidation = $request->validate(
                [
                    'password' => 'required|confirmed'
                    ]
                );
                
                $userId = Auth::id();
                $userUpdate = User::find($userId)->update($passwordValidation);
        return redirect()->route('profile.page')->with('status', 'Profile Updated Successfully!');

        }else{
            return redirect()->route('profile.edit')->with('error', 'Password does not Match our Records');
        }
          
    }

    public function createUser(){
        return view('admin.Users.create-user');
    }

    
    public function saveUser(Request $request){
        $userInfo = $request->validate(
            [
                'user_name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'role' => 'required',
            ]
        );

        $saveUser = User::create($userInfo);
        return redirect()->route('create.user')->with('status','User Created Successfully!');
    }

    public function indexUser(){
        $User = User::all();
        return view('admin.Users.index', compact('User'));
    }

    public function allUsers(Request $request){
        if ($request->ajax()){
            $Users = User::select(['id', 'user_name', 'email','role']);
            return DataTables::of($Users)->make(true);
        }
    }

    public function deleteUser(String $id){
            $user = User::find($id)->delete();

            return redirect()->back()->with('status', 'User Deleted Successfully!');
    }

    // Products Info all


    public function productIndex(){
        $allProducts = Product::all();
        return view('admin.products.index', compact('allProducts'));
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::select(['id', 'product_name', 'category', 'brand' ,'barcode' ,'expiry_date']);
            return DataTables::of($products)->make(true);
        }
    }
    
    public function addProduct(){
        $suplier = Suplier::get();
        return view('admin.products.create', compact('suplier'));
    }
    
    public function createProduct(Request $request){

        $product = $request->validate(
                    [
                    'product_name' => 'required|unique:products,product_name',
                    'category' => 'required',
                    'brand' => 'required',
                    'barcode' => 'unique:products,barcode|nullable',
                    'suplier_id' => 'required',
                    'expiry_date' => 'required',
                    ]
                );
                if($request->filled('barcode')){
                    $barcode = $request->barcode;
                }else{
                    $barcode = $this->generateNextBarcode();
                }
                
                $createProduct = Product::create(
                    [
                         'product_name'  => $request->product_name,
                         'category' => $request->category,
                         'brand' => $request->brand,
                         'barcode' => $barcode,
                         'suplier_id' => $request->suplier_id,
                         'expiry_date' => $request->expiry_date,
                    ]
                );
                return redirect()->back()->with('status', 'Product has been added Successfully!');
    }


    public function editProduct(String $id){
        $productData = Product::where('id',$id)->get();
        return view('admin.products.edit', compact('productData'));
    }
   
    public function saveProduct(Request $request, String $id){

        $deleteData = Product::find($id)->delete();
        return redirect()->route('index.product')->with('status', 'Product deleted Successfully!');
    }



    // Supplier Data all

    public function addSupplier(){
        return view('admin.Supplier.create');
    }

    public function createSupplier(Request $request){
        $supplierData = $request->validate(
            [
                'suplier_name' => 'required',
                'contact_name' => 'required',
                'contact_number' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'postal_code' => 'required',
                'tax_id' => 'required', 
                'brand' => 'required',
                'description' => 'nullable',
                'status' => 'nullable'
            ]
        );

        $createSupplier = Suplier::create($supplierData);

        return redirect()->back()->with('status', 'Supplier Created Successfully!');
    }

    public function suplierIndex(Request $request){
        $supplier = Suplier::all();
        return view('admin.Supplier.index', compact('supplier'));
    }

    public function allSuplier(Request $request){
        if ($request->ajax()) {
            $suplier = Suplier::select(['id', 'suplier_name', 'contact_name', 'contact_number' ,'email' ,'address' ,'city' ,'state' ,'postal_code' ,'tax_id' ,'status']);
            return DataTables::of($suplier)->make(true);
        }
    }

        public function editSupplier(String $id){
            $supliers = Suplier::find($id)->get();
            return view('admin.Supplier.edit', compact('supliers'));
        }

        public function saveSuplier(Request $request, String $id){
            $saveSuplier = $request->validate(
                [
                    'suplier_name' => 'required',
                    'contact_name' => 'required',
                    'contact_number' => 'required',
                    'email' => 'required',
                    'address' => 'required',
                    'city' => 'required', 
                    'postal_code' => 'required',
                    'tax_id' => 'required'
                ]
            );

            $save = Suplier::find($id)->update($saveSuplier);
            return redirect()->route('index.supplier')->with('status', 'Data Updated Successfully!');
        }

        public function createEmployee(){
            return view('admin.Employee.create');
        }

        public function saveEmployee(Request $request){
            if($request->picture && $request->id_card_picture){
                // dd(2);
                $employee_pic = time() . "-emppic." . $request->file('picture')->getClientOriginalExtension();
            $employee_id_pic = time() . "-empid." . $request->file('id_card_picture')->getClientOriginalExtension();
            $employeeData = $request->validate(
                [
                    'name' => 'required',
                    'father_name' => 'required',
                    'id_card_number' => 'required',
                    'phone_number' => 'required',
                    'dob' => 'required',
                    'salary' => 'required',
                    'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',$request->file('picture')->storeAs('public/uploads/images', $employee_pic),
                    'id_card_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',$request->file('id_card_picture')->storeAs('public/uploads/images', $employee_id_pic),
                    'joining_date' => 'required',
                    // 'leaving_date' => 'nullable'
                ]
            );
            } else{
                // dd(1);
                // $employee_pic = time() . "-emppic." . $request->file('picture')->getClientOriginalExtension();
                // $employee_id_pic = time() . "-empid." . $request->file('id_card_picture')->getClientOriginalExtension();
                $employeeData = $request->validate(
                    [
                        'name' => 'required',
                        'father_name' => 'required',
                        'id_card_number' => 'required',
                        'phone_number' => 'required',
                        'dob' => 'required',
                        'salary' => 'required',
                        // 'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',$request->file('picture')->storeAs('public/uploads/images', $employee_pic),
                        // 'id_card_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',$request->file('id_card_picture')->storeAs('public/uploads/images', $employee_id_pic),
                        'joining_date' => 'required',
                        // 'leaving_date' => 'nullable'
                    ]
                );
            }

           $saveData = Employee::create($employeeData);

           return redirect()->back()->with('status', 'Employee Created Successfully!');
        }


        public function viewEmployee(){
            $employees = Employee::all();
            return view('admin.Employee.index', compact('employees'));
        }

        public function allEmployees(Request $request){
            if ($request->ajax()) {
                $employee = Employee::select(['id', 'name', 'father_name', 'phone_number' ,'id_card_number' ,'dob' ,'salary', 'salary_status','joining_date' ,'leaving_date']);
                return DataTables::of($employee)->make(true);
            }
        }

        public function editEmployees(String $id){
            $employeeData = Employee::findOrFail($id);
            return view('admin.Employee.edit', compact('employeeData'));
        }

        public function saveEditEmployee(Request $request, String $id){
            $edits = $request->validate(
                [
                    'name' => 'required',
                    'father_name' => 'required',
                    'phone_number' => 'required',
                    'id_card_number' => 'required',
                    'dob' => 'required',
                    'salary' => 'required',
                    'salary_status' => 'required',
                    'leaving_date' => 'nullable'
                    ]
                );
                
                $saveEdit = Employee::find($id)->update($edits); 
                // dd($saveEdit);

            return redirect()->route('view.employee')->with('status', 'Record has been updated successfully!');
        }



}
