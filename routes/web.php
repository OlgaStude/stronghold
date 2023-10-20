<?php

use App\Http\Controllers\API\complainController;
use App\Http\Controllers\API\userController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('userPage');
})->name('name');

Route::get('/register', function(){
    return view('Register');
})->name('register');
Route::post('/adduser', [userController::class, 'addUser'])->name('sendUser');


Route::get('/user', function(){
    return view('UserPage');
})->name('userpage');
Route::get('/admin', function(){
    if(Auth::user()->status == 'admin'){
        $categories = Category::all();
        return view('adminPage', compact('categories'));
    }else{
        return redirect()->back();
    }
})->name('admin');

Route::get('userlogin', function(){
    return view('userLoginPage');
})->name('userlogin');
Route::post('/login', [userController::class, 'loginUser'])->name('login');


Route::get('/logout', [userController::class, 'logout'])->name('logout');


Route::post('/addcategory', [complainController::class, 'addCategory'])->name('addcategory');


Route::get('/complainspage', function(){
    return view('complainPage');
})->name('complainspage');