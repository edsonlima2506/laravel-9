<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::prefix('user')->group(function() {
    // Return all users
    Route::get('', function(User $user) {
        return $user->all();
    });

    // Return specific user by id
    Route::get('/{user}', function(User $user) {
        return $user;
    });

    // Return specific user by email
    Route::get('/{user:email}', function(User $user) {
        return $user;
    });
});

Route::get('/', function () {
    return view('welcome');
});
