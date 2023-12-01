<?php

use App\Http\Controllers\API\complainController;
use App\Http\Controllers\API\userController;
use App\Models\Category;
use App\Models\Complain;
use Illuminate\Support\Facades\Artisan;
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
    Artisan::call('storage:link');
    $complaints = Complain::join('categories', 'categories.id', '=', 'complains.categories_id')
    ->select('complains.id as complains_id', 'categories.name as category_name', 
            'complains.name', 'complains.description','complains.image_new', 'complains.image_old', 'complains.status', 
            'complains.created_at')->where('complains.status', '=', 'Решено')->get();

    return view('mainPage', compact('complaints'));
})->name('name');

Route::get('/register', function(){
    
    Artisan::call('storage:link');
    return view('Register');
})->name('register');
Route::post('/adduser', [userController::class, 'addUser'])->name('sendUser');
Route::post('/solved', [complainController::class, 'changeStatus'])->name('solved');
Route::post('/decline', [complainController::class, 'decline'])->name('decline');
Route::get('/deletecategory', [complainController::class, 'categoryDelete'])->name('deletecategory');


Route::get('/user', function(){
    $complaints = Complain::join('categories', 'categories.id', '=', 'complains.categories_id')
    ->where('users_id', '=', Auth::user()->id)
    ->select('complains.id as complains_id', 'categories.name as category_name', 
            'complains.name', 'complains.description', 'complains.image_old', 'complains.status', 
            'complains.created_at')->get();

        return view('UserPage', compact('complaints'));
})->name('userpage');
Route::get('/admin', function(){
    Artisan::call('storage:link');
    if(Auth::user()->status == 'admin'){
        $categories = Category::all();
        $complaints = Complain::join('categories', 'categories.id', '=', 'complains.categories_id')
                    ->select('complains.id as complains_id', 'categories.name as category_name', 
                            'complains.name', 'complains.description', 'complains.image_old', 'complains.status', 
                            'complains.created_at')->where('complains.status', '=', 'Новая')->get();

        return view('adminPage', compact('categories', 'complaints'));
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
    $categories = Category::all();
    return view('complainPage', compact('categories'));
})->name('complainspage');
Route::post('/addcomplaint', [complainController::class, 'addComplaint'])->name('addcomplaint');
Route::get('/removecomplaint/{id}', [complainController::class, 'complaintDelete'])->name('removecomplaint');