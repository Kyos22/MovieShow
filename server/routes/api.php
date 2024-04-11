<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
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



