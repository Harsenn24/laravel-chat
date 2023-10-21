<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auths.login');
})->name('auth.login');


Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.registerForm');

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('/login', [AuthController::class, 'login'])->name('auth.loginProcess');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('jwt');

Route::get('/user-data', [ContentController::class, 'showUser'])->name('content.showUser')->middleware('jwt');

Route::post('/user-data/add-friend/{id}', [ContentController::class, 'addUserAsFriend'])->name('content.addFriend')->middleware('jwt');

Route::get('/user-data/show-chat/{id}', [PusherController::class, 'index'])->name('pusher.index')->middleware('jwt');

Route::post('/delete-user/{id}', [ContentController::class, 'deleteUser'])->name('content.deleteUser')->middleware('jwt')->middleware('authorization');

Route::get('/edit-user/{id}', [ContentController::class, 'EditUserForm'])->name('content.editUser')->middleware('jwt')->middleware('authorization');

Route::post('/edit-user/{id}', [ContentController::class, 'EditUser'])->name('content.editUserPost')->middleware('jwt')->middleware('authorization');

Route::post('/broadcast/{id}', [PusherController::class, 'broadcast'])->name('pusher.broadcast')->middleware('jwt');

Route::post('/receive/{id}', [PusherController::class, 'receive'])->name('pusher.receive')->middleware('jwt');

// Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

// Route::post('/product', [ProductController::class, 'store'])->name('product.store');

// Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

// Route::post('/product/{id}/edit', [ProductController::class, 'edit_existing_product'])->name('product.edit_existing');

// Route::delete('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
