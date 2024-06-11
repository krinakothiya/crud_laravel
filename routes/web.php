<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/form/create', [ProductController::class, 'create'])->name('create');              // use to create user from
Route::post('/create', [ProductController::class, 'store'])->name('user.store');               // use to store data in database


Route::get('/form/{product}/edit', [ProductController::class, 'edit'])->name('edit');        // it is use to fetch data and create edit from
Route::PATCH('/form/{product}', [ProductController::class, 'update'])->name('user.update');        // create route for update the user details
Route::delete('/product/delete_image', [ProductController::class, 'deleteImage'])->name('delete_image');

Route::delete('/form/delete/{id}', [ProductController::class, 'delete'])->name('user.delete');          // create route for delete user
