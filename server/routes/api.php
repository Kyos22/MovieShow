<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//AccountController
Route::post('/signUp',[UserController::class,'register']);
Route::post('/signIn',[UserController::class,'logIn']);
Route::put('/forgetPassword',[UserController::class,'forgetPassword']);
Route::put('/changePassword/{id}',[UserController::class,'changePassword']);
Route::put('/editCustomer/{id}',[UserController::class,'editCustomer']);
//AdminController
Route::get('/getGenre',[AdminController::class,'getGenre']);
Route::get('/getQualify',[AdminController::class,'getQualify']);
Route::post('/registerAdmin',[AdminController::class,'registerAdmin']);
Route::delete('/deleteAdmin/{id}',[AdminController::class,'deleteAdmin']);
Route::put('/changePassword/{id}',[AdminController::class,'changePassword']);
Route::put('/editAdmin/{id}',[AdminController::class,'editAdmin']);
Route::put('/forgotpasswordAdmin',[AdminController::class,'forgotpasswordAdmin']);
Route::get('/banUser/{id}',[AdminController::class,'banUser']);
//MovieController
Route::post('/addMovie',[MovieController::class,'addMovie']);
Route::get('/getMovie',[MovieController::class,'getMovie']);
Route::delete('/deleteMovie/{id}',[MovieController::class,'deleteMovie']);
Route::put('/editMovie/{id}',[MovieController::class,'editMovie']);
Route::put('/changeStatus/{id}',[MovieController::class,'changeStatus']);
Route::get('/showDetailMovie/{id}',[MovieController::class,'showDetailMovie']);
Route::get('/showMovieCreated',[MovieController::class,'showMovieCreated']);
Route::get('/findByKeyword',[MovieController::class,'findByKeyword']);
//PackageController
Route::post('/addPackage',[PackageController::class,'addPackage']);
Route::get('/getPackage',[PackageController::class,'getPackage']);
Route::delete('/deletePackage/{id}',[PackageController::class,'deletePackage']);
Route::put('/editPackage/{id}',[PackageController::class,'editPackage']);
//CountryController
Route::post('/addCountry',[CountryController::class,'addCountry']);
Route::get('/getCountry',[CountryController::class,'getCountry']);
                /*the same as with editCountry and deleteCountry*/
//PaypalPaymentController
Route::post('/payment/paypal/create/{idCart}', [PaypalController::class,'createPayment']);
Route::post('/payment/paypal/execute', [PaypalController::class,'executePayment']);
Route::post('/paypal/payment', [PaypalController::class, 'charge']);
Route::post('/charge', [PaypalController::class, 'charge']);
//PaymentMethodController
Route::post('/addPaymentMethod',[PaymentController::class,'addPaymentMethod']);
Route::get('/getPaymentMethod',[PaymentController::class,'getPaymentMethod']);
Route::post('/addProductToOrders/{id}',[PaymentController::class,'addProductToOrders']);
//CartController
Route::post('/addCart/{idCustomer}/{idPackage}',[CartController::class,'addCart']);
Route::put('/updateQuantityPackage/{idCustomer}/{idCart}',[CartController::class,'updateQuantityPackage']);
Route::delete('/deleteCart/{idCart}',[CartController::class,'deleteCart']);
//OrderController
Route::get('/getOrdersCustomer/{id}',[OrderController::class,'getOrdersCustomer']);
Route::get('/calculateAllAvenue',[OrderController::class,'calculateAllAvenue']);
Route::get('/calculateRevenuePermonth',[OrderController::class,'calculateRevenuePermonth']);
Route::get('/revenueOfEachPackage',[OrderController::class,'revenueOfEachPackage']);
Route::get('/countEachPackage',[OrderController::class,'countEachPackage']);
Route::get('/revenueCountry',[OrderController::class,'revenueCountry']);
Route::get('/popularPackage',[OrderController::class,'popularPackage']);
Route::get('/getAllOrder',[OrderController::class,'getAllOrder']);










