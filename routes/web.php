<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('index');});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/

    Route::get('sendbasicemail',[App\Http\Controllers\MailController::class, 'basic_email']);
    Route::get('sendhtmlemail',[App\Http\Controllers\MailController::class, 'html_email']);
    Route::get('sendattachmentemail',[App\Http\Controllers\MailController::class, 'attachment_email']);

    Route::get('repair', function () {
        $locations = DB::table('users')->where(['type'=>'2'])->groupBy('location')->get();
        $services = DB::table('services')->get();
        return view('repair', ['locations' => $locations, 'services' => $services]);
    });

    Route::get('purchase', function () {
        $locations = DB::table('users')->where(['type'=>'2'])->groupBy('location')->get();
        $garages = DB::table('users')->where(['type'=>'2'])->orderBy('name')->get();
        return view('purchase', ['locations' => $locations, 'garages' => $garages]);
    });
    
    Route::get('transport',[App\Http\Controllers\TransportController::class, 'index']);

    Route::get('sell',[App\Http\Controllers\SellController::class, 'index']);

    Route::get('contact',[App\Http\Controllers\ContactController::class, 'index']);
    Route::post('contact',[App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

    Route::get('sendMail', [App\Http\Controllers\MailController::class, 'index']);

    //Sending Email
    Route::get('send-mail', function () {
   
        $details = [
            'title' => 'Mail from autoguru.com',
            'body' => 'This is for testing email using smtp'
        ];
       
        \Mail::to('pioneerdev1023@gmail.com')->send(new \App\Mail\MyTestMail($details));
       
        dd("Email is Sent.");
    });

    

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('repair/getCarDetailXML/{num}', [App\Http\Controllers\RepairController::class, 'getCarDetailXML']);
    Route::post('repair',[App\Http\Controllers\RepairController::class, 'store'])->name('repair.store');
    Route::get('repairConfirm', function () { return view('repairConfirm');})->name('repairConfirm');

    Route::post('purchase',[App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('purchase/getRegDetail', [App\Http\Controllers\PurchaseController::class, 'getRegDetail']);
    Route::get('purchaseConfirm', function () { return view('purchaseConfirm');})->name('purchaseConfirm');

    Route::post('sell',[App\Http\Controllers\SellController::class, 'store'])->name('sell.store');
    Route::get('sellConfirm', function () { return view('sellConfirm');})->name('sellConfirm');

    Route::post('transport',[App\Http\Controllers\TransportController::class, 'store'])->name('transport.store');
    Route::get('transportPayment', [App\Http\Controllers\TransportController::class, 'stripe'])->name('transport.payment');
    Route::post('transportPayment',[App\Http\Controllers\TransportController::class, 'stripePost'])->name('transport.stripe');
    Route::get('transportConfirm', function () { return view('transportConfirm');})->name('transportConfirm');

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('prepurchase', [App\Http\Controllers\PrePurchaseController::class, 'index'])->name('prepurchase');

    Route::get('booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking');
    Route::post('booking/reply', [App\Http\Controllers\BookingController::class, 'reply'])->name('booking.reply');
    Route::post('bookingPayment',[App\Http\Controllers\BookingController::class, 'stripePost'])->name('booking.stripe');

    Route::get('quote', [App\Http\Controllers\QuoteController::class, 'index'])->name('quote');
    Route::post('quote/reply', [App\Http\Controllers\QuoteController::class, 'reply'])->name('quote.reply');
    Route::post('quotePayment',[App\Http\Controllers\QuoteController::class, 'stripePost'])->name('quote.stripe');
    
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('edit-profile/name',[App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
    Route::post('edit-profile/password',[App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::resource('admin/adminDashboard', App\Http\Controllers\Admin\AdminDashboardController::class);
    Route::resource('admin/adminRepair', App\Http\Controllers\Admin\AdminRepairController::class);
    Route::resource('admin/adminUser', App\Http\Controllers\Admin\AdminUserController::class);
    Route::resource('admin/adminNewUser', App\Http\Controllers\Admin\AdminNewUserController::class);
    Route::resource('admin/adminLocation', App\Http\Controllers\Admin\AdminLocationController::class);
    Route::resource('admin/adminNewLocation', App\Http\Controllers\Admin\AdminNewLocationController::class);
    Route::resource('admin/adminTransport', App\Http\Controllers\Admin\AdminTransportController::class);
    Route::resource('admin/adminSell', App\Http\Controllers\Admin\AdminSellController::class);
    Route::resource('admin/adminService', App\Http\Controllers\Admin\AdminServiceController::class);
    Route::resource('admin/adminPurchase', App\Http\Controllers\Admin\AdminPurchaseController::class);
    Route::resource('admin/adminCost', App\Http\Controllers\Admin\AdminCostController::class);
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/managerDashboard', [App\Http\Controllers\Manager\ManagerDashboardController::class, 'index'])->name('manager.managerDashboard');
    Route::get('/manager/managerQuote', [App\Http\Controllers\Manager\ManagerQuoteController::class, 'index'])->name('manager.managerQuote');
    Route::post('/manager/managerQuote/reply', [App\Http\Controllers\Manager\ManagerQuoteController::class, 'reply'])->name('manager.managerQuoteReply');
    Route::get('/manager/managerBooking', [App\Http\Controllers\Manager\ManagerBookingController::class, 'index'])->name('manager.managerBooking');
    Route::post('/manager/managerBooking/reply', [App\Http\Controllers\Manager\ManagerBookingController::class, 'reply'])->name('manager.managerBookingReply');
    Route::get('/manager/managerPurchase', [App\Http\Controllers\Manager\ManagerPurchaseController::class, 'index'])->name('manager.managerPurchase');
    Route::get('/manager/managerProfile', [App\Http\Controllers\Manager\ManagerProfileController::class, 'index'])->name('manager.managerProfile');
});
  
