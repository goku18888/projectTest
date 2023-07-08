<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ChangePassController;
use App\Http\Controllers\Cilent\CommmentController;
use App\Http\Controllers\Cilent\IndexController;
use App\Http\Controllers\Cilent\PayPalController as CilentPayPalController;
use App\Http\Controllers\Cilent\UserController;
use App\Http\Controllers\Cilent\UserProfileController as CilentUserProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MoneyDashboard;
use App\Http\Controllers\OrderDashboard;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProducttypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ADMIN
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/process_login',[LoginController::class,'ProcessLogin'])->name('ProcessLogin');
Route::get('/admin_register',[LoginController::class,'Register'])->name('Register');
Route::post('/process_register',[LoginController::class,'ProcessRegister'])->name('ProcessRegister');

Route::get('/forgot-password',[LoginController::class,'forgotPassword'])->name('forgotPassword');
Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('forgot-password');
Route::get('/forgot-password/{token}',[LoginController::class,'forgotPasswordValidate'])->name('forgotPasswordValidate');

Route::put('reset-password', [LoginController::class, 'updatePassword'])->name('reset-password');

Route::prefix('admin')->name('ad.')->middleware('checkLogin')->group(function () {
    Route::get('/logout',[LoginController::class,'Logout'])->name('logout');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::get('/edit_profile/{id}',[ProfileController::class,'edit'])->name('profiledit');
    Route::put('/update_profile/{id}',[ProfileController::class,'update'])->name('profiled');
    Route::delete('/destroy_profile/{id}',[ProfileController::class,'destroy'])->name('destroyp');

    Route::get('/changePassword',[ChangePassController::class,'edit'])->name('changePassword');
    Route::patch('/changePassword/{id}',[ChangePassController::class,'update'])->name('updatePassword');

    Route::get('/images/{id}',[ProductController::class,'images'])->name('images');

    Route::get('/products',[ProductController::class,'index'])->name('detail');
    Route::get('/add',[ProductController::class,'create'])->name('add');
    Route::post('/add',[ProductController::class,'store'])->name('processadd');
    Route::delete('/destroy/{id}',[ProductController::class,'destroy'])->name('destroy');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
    Route::put('/update/{id}',[ProductController::class,'update'])->name('update');
    Route::get('/products/api',[ProductController::class,'api'])->name('proapi');
    //serach js
    Route::post('/autocomplete-ajax-products-view',[ProductController::class,'autocomplete_ajax_products_view'])->name('autocomplete_ajax_products_view');
    //messenger
    Route::post('/ajax-update-status',[ProductController::class,'updateStatus'])->name('updateStatus');
    //billSenger
    Route::post('/ajax-update-status-billSenger',[ProductController::class,'updateBillV'])->name('updateBillV');
    //user information
    Route::get('/user',[ProductController::class,'user'])->name('user');
    Route::delete('/user_delete/{id}',[ProductController::class,'userDelete'])->name('userDelete');
    //user bill
    Route::get('/bill-user/{id}',[ProductController::class,'userBill'])->name('userBill');
    Route::delete('/bill-delete/{id}',[ProductController::class,'billDelete'])->name('billDelete');
    Route::get('/billDetails/{id}',[ProductController::class,'billDetails'])->name('billDetails');
    //All bill
    Route::get('/bill-all',[ProductController::class,'viewBillAll'])->name('viewBillAll');
    Route::delete('/bill-all-delete/{id}',[ProductController::class,'deleteBillAll'])->name('deleteBillAll');
    //PDF
    Route::get('/print-bill/{id}',[ProductController::class,'print_bill'])->name('print_bill');
    //Status change
    Route::post('/status-change',[ProductController::class,'status_change'])->name('status_change');   
    //supplier
    Route::get('/suppliers',[SupplierController::class,'index'])->name('details');
    Route::get('/supplieradd',[SupplierController::class,'create'])->name('sup');
    Route::post('/supplieradd',[SupplierController::class,'store'])->name('supadd');
    Route::delete('/supplier/{id}',[SupplierController::class,'destroy'])->name('destroysup');
    Route::get('/supplieredit/{id}',[SupplierController::class,'edit'])->name('supedit');
    Route::put('/supplierupdate/{id}',[SupplierController::class,'update'])->name('supupdate');
    //product_type
    Route::get('/producttype',[ProducttypeController::class,'index'])->name('type_detail');
    Route::get('/producttype_add',[ProducttypeController::class,'create'])->name('type');
    Route::post('/producttype_add',[ProducttypeController::class,'store'])->name('typeadd');
    Route::delete('/producttype_delete/{id}',[ProducttypeController::class,'destroy'])->name('destroytype');
    Route::get('/producttype_edit/{id}',[ProducttypeController::class,'edit'])->name('edittype');
    Route::put('/producttype_update/{id}',[ProducttypeController::class,'update'])->name('updatetype');
    //Comment
    Route::get('/comment',[CommentController::class,'list_comment'])->name('list_comment');
    Route::post('/allow-comment',[CommentController::class,'allow_comment'])->name('allow_comment');
    Route::post('/reply-comment',[CommentController::class,'reply_comment'])->name('reply_comment');
    Route::delete('/comment/{id}',[CommentController::class,'delete_comment'])->name('delete_comment');
    //Dash Board
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/filter-by-date',[DashboardController::class,'filter_by_date'])->name('filter_by_date');
    Route::post('/dashboard-filter',[DashboardController::class,'dashboard_filter'])->name('dashboard_filter');
    Route::post('/days-order',[DashboardController::class,'days_order'])->name('days_order');
    //Money Dashboard
    Route::get('/Money-dashboard-m',[MoneyDashboard::class,'MoneyDashboard'])->name('moneyDashboard');
    Route::post('/filter-by-date-m',[MoneyDashboard::class,'filter_by_date'])->name('filter_by_date_m');
    Route::post('/dashboard-filter-m',[MoneyDashboard::class,'dashboard_filter'])->name('dashboard_filter_m');
    Route::post('/days-order-m',[MoneyDashboard::class,'days_order'])->name('days_order_m');
    //Order Dashboard
    Route::get('/Order-dashboard-o',[OrderDashboard::class,'OrderDashboard'])->name('orderDashboard');
    Route::post('/filter-by-date-o',[OrderDashboard::class,'filter_by_date'])->name('filter_by_date_o');
    Route::post('/dashboard-filter-o',[OrderDashboard::class,'dashboard_filter'])->name('dashboard_filter_o');
    Route::post('/days-order-o',[OrderDashboard::class,'days_order'])->name('days_order_o');
    //Search
    Route::post('/autocomplete-ajax-topbar',[ProductController::class,'autocomplete_ajax'])->name('autocomplete_ajax');
    Route::post('/autocomplete-ajax-viewuser',[ProductController::class,'autocomplete_ajax_viewuser'])->name('autocomplete_ajax_viewuser');
    //Delivery
    Route::get('/delivery',[DeliveryController::class,'delivery'])->name('delivery');
    Route::post('/select-delivery',[DeliveryController::class,'select_delivery'])->name('select_delivery');
    Route::post('/insert-delivery',[DeliveryController::class,'insert_delivery'])->name('insert_delivery');
    Route::post('/select-feeship',[DeliveryController::class,'select_feeship'])->name('select_feeship');
    Route::post('/update-delivery',[DeliveryController::class,'update_delivery'])->name('update_delivery');
    //Code Ship
    Route::post('/update-code-delivery',[DeliveryController::class,'update_code_delivery'])->name('update_code_delivery');
});
//CILENT
// Auth::routes(['verify' => true]);->middleware('verified')
Route::prefix('user')->name('us.')->group(function () {
    route::get('/index',[IndexController::class,'index'])->name('index');
    Route::get('/detail/{id}',[IndexController::class,'details'])->name('detail');
    Route::get('/detail',[IndexController::class,'viewfeedback'])->name('feedback');
    Route::post('/detail',[IndexController::class,'storefeedback'])->name('storefeedback');
    Route::get('/about',[IndexController::class,'about'])->name('about');
    Route::get('/contact',[IndexController::class,'contact'])->name('contact');

    Route::get('/loginuser',[UserController::class,'create'])->name('userLogin');
    Route::post('/process_loginuser',[UserController::class,'ProcessLogin'])->name('userPrLogin');
    Route::get('register',[UserController::class,'Register'])->name('userRegister');
    Route::post('user_register',[UserController::class,'ProcessRegister'])->name('ProRegister');
    Route::get('user_logout',[UserController::class,'logout'])->name('user_logout');

    Route::get('forgot_password',[UserController::class,'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [UserController::class, 'resetPassword'])->name('forgot-password');
    Route::get('forgot-password/{token}',[UserController::class,'forgotPasswordValidate'])->name('forgotPasswordValidate');

    Route::put('reset_password', [UserController::class, 'updatePassword'])->name('reset-password');
    //check if you are admin
    Route::get('question',[UserController::class,'question'])->name('QuesTion');
    Route::post('question-answer',[UserController::class,'questionAn'])->name('QuesTionAn');
    //cart
    Route::get('/add_to_cart/{id}',[IndexController::class,'addToCart'])->name('addToCart');
    Route::get('/show_cart',[IndexController::class,'showCart'])->name('showCart');
    Route::get('/update_cart',[IndexController::class,'updateCart'])->name('updateCart');
    Route::get('/delete_cart',[IndexController::class,'deleteCart'])->name('deleteCart');
    Route::post('/addBill',[IndexController::class,'addBill'])->name('addBill');
    Route::get('/showBill/{id}',[CilentUserProfileController::class,'showBill'])->name('showBill');
    Route::get('/billDetails/{id}',[CilentUserProfileController::class,'billDetails'])->name('billDetails');
    //cancel order cart
    Route::post('/delete-order',[CilentUserProfileController::class,'delete_order'])->name('delete-order');
    //cart delivery
    Route::get('/del-fee',[DeliveryController::class,'del_fee'])->name('del-fee');
    Route::post('/select-delivery-home',[DeliveryController::class,'select_delivery_home'])->name('select-delivery-home');
    Route::post('/calculate-fee',[DeliveryController::class,'calculate_fee'])->name('calculate-fee');
    Route::get('/info-customer',[DeliveryController::class,'info_customer'])->name('info-customer');
    Route::post('/send-info',[DeliveryController::class,'send_info'])->name('send-info');
    //Profile
    Route::get('profile',[CilentUserProfileController::class,'index'])->name('profile');
    Route::get('/edit_profile/{id}',[CilentUserProfileController::class,'edit'])->name('profiledit');
    Route::put('/update_profile/{id}',[CilentUserProfileController::class,'update'])->name('profiled');
    Route::delete('/destroy_profile_user/{id}',[CilentUserProfileController::class,'destroy'])->name('destroypp');
    //comment
    Route::post('/load-comment',[IndexController::class,'load_comment'])->name('load_comment');
    Route::post('/send-comment',[IndexController::class,'send_comment'])->name('send_comment');
    //rating stars
    Route::post('/insert-rating',[IndexController::class,'insert_rating'])->name('insert_rating');
    //serach
    Route::post('/autocomplete-ajax-indexuser',[IndexController::class,'autocomplete_ajax_indexuser'])->name('autocomplete_ajax_indexuser');
    //PayPal
    Route::get('create-transaction', [CilentPayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::get('process-transaction', [CilentPayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [CilentPayPalController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [CilentPayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
});