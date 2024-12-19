<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PettyCashController;

// create user routes

Route::get('/', function () {return view('home');})->name('home');
Route::get('/create-user-page', [AdminController::class, 'createUser'])->name('create.user')->middleware('admin');
Route::post('/save-user', [AdminController::class, 'saveUser'])->name('save.user')->middleware('admin');
Route::get('/index-user-page', [AdminController::class, 'indexUser'])->name('index.user')->middleware('admin');
Route::get('/all-users', [AdminController::class, 'allUsers'])->name('all.users')->middleware('admin');
Route::get('/edit-user-page', [AdminController::class, 'editUser'])->name('edit.user')->middleware('admin');
Route::post('/edit-user', [AdminController::class, 'saveEdit'])->name('save.edit')->middleware('usercheck');
Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete.user')->middleware('admin');

// authorization routes

Route::get('/login', [UserController::class, 'loginPage'])->name('login.page');
Route::post('/user-login', [UserController::class, 'userLogin'])->name('user.login');
Route::get('/user-logout', [UserController::class, 'userLogout'])->name('user.logout');
Route::get('/profile-page', [AdminController::class, 'profileIndex'])->name('profile.page')->middleware('usercheck');
Route::get('/profile-edit', [AdminController::class, 'profileEdit'])->name('profile.edit')->middleware('usercheck');
Route::post('/save-edit/{id}', [AdminController::class, 'saveProfile'])->name('save.profile')->middleware('usercheck');

// employee routes

Route::get('/create-employee-page', [AdminController::class, 'createEmployee'])->name('create.employee')->middleware('admin');
Route::post('/save-employee', [AdminController::class, 'saveEmployee'])->name('save.employee')->middleware('admin');
Route::get('/view-employee-page', [AdminController::class, 'viewEmployee'])->name('view.employee')->middleware('admin');
Route::get('/all-employee-page', [AdminController::class, 'allEmployees'])->name('all.employees')->middleware('admin');
Route::get('/edit-employee-page/{id}', [AdminController::class, 'editEmployees'])->name('edit.employees')->middleware('admin');
Route::post('/edit-employee/{id}', [AdminController::class, 'saveEditEmployee'])->name('save.edit')->middleware('admin');

// Expense Routes
Route::get('/index-expense', [ExpenseController::class, 'indexExpenses'])->name('expense.index')->middleware('admin');
Route::get('/get-expense-data', [ExpenseController::class, 'getExpenses'])->name('get.expense')->middleware('admin');
Route::get('/get-other-expense-data', [ExpenseController::class, 'getOtherExpenses'])->name('other.expense')->middleware('admin');
Route::get('/create-expense-page', [ExpenseController::class, 'createExpense'])->name('create.expense')->middleware('admin');
Route::post('/save-expense', [ExpenseController::class, 'saveExpense'])->name('save.expense')->middleware('admin');


// profit loss routes
Route::get('/profit-index', [ProfitController::class, 'profitIndex'])->name('profit.index')->middleware('admin');
Route::get('/fetch-profit-loss', [ProfitController::class, 'fetchProfitLoss'])->name('fetch.profit.loss');
Route::get('/download-profit-loss-report', [ProfitController::class, 'downloadProfitLossReport'])->name('download.profit.loss.report');

// admin pannel routes

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');
Route::get('/product-index', [AdminController::class, 'productIndex'])->name('index.product')->middleware('admin');
Route::get('/all-products', [AdminController::class, 'getProducts'])->name('all.products')->middleware('admin');
Route::get('/add-product', [AdminController::class, 'addProduct'])->name('add.product')->middleware('admin');
Route::post('/create-product', [AdminController::class, 'createProduct'])->name('create.product')->middleware('admin');
Route::get('/delete-product/{id}', [AdminController::class, 'saveProduct'])->name('delete.product')->middleware('admin');

// purchases routes

Route::get('/add-purchase', [ProductController::class, 'purchaseBarcode'])->name('purchase.barcode')->middleware('admin');
Route::get('/product/barcode/{barcode}', [ProductController::class, 'fetchProductByBarcode']);
Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update.product')->middleware('admin');
Route::get('/purchases-index', [ProductController::class, 'purchasesIndex'])->name('purchases.index')->middleware('admin');
Route::get('/purchase-details/{id}', [ProductController::class, 'purchaseDetails'])->name('purchase.details')->middleware('admin');
Route::get('/purchases/search', [ProductController::class, 'searchrec'])->name('purchases.search');


// suppliers and sales routes

Route::get('/all-supplier', [AdminController::class, 'allSuplier'])->name('all.suplier')->middleware('admin');
Route::get('/index-supplier', [AdminController::class, 'suplierIndex'])->name('index.supplier')->middleware('admin');
Route::get('/add-supplier', [AdminController::class, 'addSupplier'])->name('add.supplier')->middleware('admin');
Route::post('/create-supplier', [AdminController::class, 'createSupplier'])->name('create.supplier')->middleware('admin');
Route::get('/edit-supplier/{id}', [AdminController::class, 'editSupplier'])->name('edit.supplier')->middleware('admin');
Route::post('/save-supplier/{id}', [AdminController::class, 'saveSuplier'])->name('save.supplier')->middleware('admin');
Route::get('/all-sales', [SaleController::class, 'allSales'])->name('all.sales')->middleware('admin');
Route::get('/total-sales', [SaleController::class, 'totalSales'])->name('total.sales')->middleware('admin');
Route::get('/today-sales', [SaleController::class, 'todaySales'])->name('today.sales')->middleware('admin');
Route::get('/sales/{cashier_id}', [SaleController::class, 'salesByCashier'])->name('sales.by.cashier');


Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index')->middleware('manager');
Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index')->middleware('cashier');
Route::get('/products', [ProductController::class, 'index'])->name('dataentry.index')->middleware('dataentry');


// cashier products - prinf - pdf routes
Route::post('/fetch-product', [CashierController::class, 'fetchProduct']);
Route::post('/save-order', [SaleController::class, 'saveOrder'])->name('save.order');
Route::post('/calculate-total', [CashierController::class, 'calculateTotal']);
Route::get('/search-products', [ProductController::class, 'search']);
Route::post('/get-product-details', [ProductController::class, 'getProductDetails']);
Route::post('/save-pdf-order', [CashierController::class, 'savePdfOrder']);
Route::get('/print-order/{id}', [CashierController::class, 'printOrder']);
Route::get('/orders/today', [SaleController::class, 'showTodayOrders'])->name('orders.today');
Route::get('/orders/{orderId}/details', [SaleController::class, 'viewOrderDetails'])->name('orders.details');
Route::post('/check-stock', [InventoryController::class, 'checkStock'])->name('check.stock');
Route::get('/get-products', [CashierController::class, 'getProducts']);
Route::get('/get-product-by-barcode/{barcode}', [CashierController::class, 'getProductByBarcode']);

// petty cash routes

Route::get('petty-cash/create', [PettyCashController::class, 'create'])->name('petty-cash.create')->middleware('admin');
Route::post('petty-cash', [PettyCashController::class, 'store'])->name('petty-cash.store')->middleware('admin');
Route::get('/cashier/petty-cash-popup', [PettyCashController::class, 'showPopup']);
Route::post('/cashier/mark-notification-read', [PettyCashController::class, 'markNotificationRead']);
Route::post('/cashier/mark-notification-read', [PettyCashController::class, 'markNotificationRead']);
