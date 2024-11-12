<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\BnLocationController;
use App\Http\Controllers\BuildingDetailController;
use App\Http\Controllers\buyProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


// Web API Routes
Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);


// User Logout
Route::get('/logout',[UserController::class,'UserLogout']);

// Page Routes
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);




Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/productPage',[ProductController::class,'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/invoicePage',[InvoiceController::class,'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/salePage',[InvoiceController::class,'SalePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/reportPage',[ReportController::class,'ReportPage'])->middleware([TokenVerificationMiddleware::class]);






// Category API
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/category-by-id",[CategoryController::class,'CategoryByID'])->middleware([TokenVerificationMiddleware::class]);


// Customer API
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/customer-by-id",[CustomerController::class,'CustomerByID'])->middleware([TokenVerificationMiddleware::class]);

//buy product Route
Route::get('/buy-product', [buyProductController::class, 'index'])->middleware([TokenVerificationMiddleware::class]);

//buy product API
Route::get('/buying-details', [buyProductController::class, 'buyingDetails'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/buying-details-store', [buyProductController::class, 'store'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/buying-details-by-id', [buyProductController::class, 'show'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/buying-details-update/{id}', [buyProductController::class, 'update'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/buying-details-delete', [buyProductController::class, 'destroy'])->middleware([TokenVerificationMiddleware::class]);


//Store Route
Route::get('/store-products', [StoreController::class, 'index'])->middleware([TokenVerificationMiddleware::class]);
//Store API
Route::get('/store-products-list', [StoreController::class, 'storeList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/store-products-create', [StoreController::class, 'storeCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/store-item-by-id', [StoreController::class, 'storeItemById'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/store-update/{id}', [StoreController::class, 'storeItemUpdate'])->middleware([TokenVerificationMiddleware::class]);


//Collection Route
Route::get("/collection",[CollectionController::class,'CollectionPage'])->middleware([TokenVerificationMiddleware::class]);

//Collection API
Route::get("/collection-list", [CollectionController::class, 'CollectionList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/collection-create", [CollectionController::class, 'CollectionCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/collection-by-id", [CollectionController::class, 'CollectionById'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/collection-update/{id}", [CollectionController::class, 'CollectionUpdate'])->middleware([TokenVerificationMiddleware::class]);

// Product API
Route::post("/create-product",[ProductController::class,'CreateProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-product",[ProductController::class,'DeleteProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-product",[ProductController::class,'UpdateProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/product-by-id",[ProductController::class,'ProductByID'])->middleware([TokenVerificationMiddleware::class]);



// Invoice
Route::post("/invoice-create",[InvoiceController::class,'invoiceCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/invoice-select",[InvoiceController::class,'invoiceSelect'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/invoice-details",[InvoiceController::class,'InvoiceDetails'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/invoice-delete",[InvoiceController::class,'invoiceDelete'])->middleware([TokenVerificationMiddleware::class]);


// SUMMARY & Report
Route::get("/summary",[DashboardController::class,'Summary'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/sales-report/{FormDate}/{ToDate}",[ReportController::class,'SalesReport'])->middleware([TokenVerificationMiddleware::class]);

//division API
Route::get('/division', [BnLocationController::class, 'Division']);
Route::get('/district', [BnLocationController::class, 'District']);
Route::get('/upazila', [BnLocationController::class, 'Upazila']);
Route::get('/union', [BnLocationController::class, 'Union']);

//employees Route
Route::get("/employee",[EmployeeController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
//Employees API
Route::get("/employee-list",[EmployeeController::class,'EmployeeList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/employee-create",[EmployeeController::class,'EmployeeCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/employee-by-id",[EmployeeController::class,'EmployeeById'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/employees-update",[EmployeeController::class,'EmployeeUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/employee-delete",[EmployeeController::class,'EmployeeDelete'])->middleware([TokenVerificationMiddleware::class]);

//Agent Route
Route::get("/agent",[AgentController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
//Agent API
Route::get("/agent-list",[AgentController::class,'AgentList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/agent-create",[AgentController::class,'AgentCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/agent-by-id",[AgentController::class,'AgentById'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/agents-update",[AgentController::class,'AgentUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/agent-delete",[AgentController::class,'AgentDelete'])->middleware([TokenVerificationMiddleware::class]);

//owner Route
Route::get("/owner",[OwnerController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
//owner API
Route::get("/owner-list",[OwnerController::class,'OwnerList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/owner-create",[OwnerController::class,'OwnerCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/owner-by-id",[OwnerController::class,'OwnerById'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/owners-update",[OwnerController::class,'OwnerUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/owner-delete",[OwnerController::class,'OwnerDelete'])->middleware([TokenVerificationMiddleware::class]);

//Building Route
Route::get("/building-detail",[BuildingDetailController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
//Building API
Route::get("/building-detail-list",[BuildingDetailController::class,'BuildingList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/building-detail-create",[BuildingDetailController::class,'BuildingCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/building-detail-by-id",[BuildingDetailController::class,'BuildingById'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/buildings-detail-update",[BuildingDetailController::class,'BuildingUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/building-detail-delete",[BuildingDetailController::class,'BuildingDelete'])->middleware([TokenVerificationMiddleware::class]);
