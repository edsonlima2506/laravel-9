<?php

use App\Models\User;
use Illuminate\Http\Request;
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
Route::prefix('request')->group(function() {
    // Return query string from URL
    Route::get('', function(Request $request) {
        return $request->query();
    });

    // Return specific query string from URL content
    Route::get('/query', function(Request $request) {
        // 'Keyword' is the name of query input
        return $request->input('keyword');
    });

    Route::get('/url', function(Request $request) {
        // Without Query String...
        $url = $request->url();
        
        // With Query String...
        $fullUrl = $request->fullUrl();

        return [$url, $fullUrl];
    });

    // Return only specific data
    Route::get('/only', function(Request $request) {
        return $request->only(['username', 'password']);
    });

    // Returns all data except the indicated ones
    Route::get('/except', function(Request $request) {
        return $request->except(['username', 'password']);
    });

    // Returns all data except the indicated ones
    Route::get('/validate', function(Request $request) {
        // Validate if all of the specified values are present
        $has = $request->has(['name', 'email']);

        // When all of the specified values are present, execute the function
        $request->whenHas('name', function($input) {
            echo $input;
        });

        // Validate if any of the specified values are present
        $hasAny = $request->hasAny(['name', 'email']);

        // Validate if a value is present on the request and is not empty
        $filled = $request->filled('name');

        // When all of the specified values are present and is not empty, execute the function
        $request->whenFilled('name', function($input) {
            echo $input;
        });

        // Validate if a given key is absent from the request
        $missing = $request->missing('name');

        return;
    });

});

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
