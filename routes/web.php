<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

// store Listing data
Route::Post('/listings', [ListingController::class, 'store']);

// show Edit form
Route::get('/listings/{id}/edit', [ListingController::class, 'edit']);

// update Edit form
Route::put('/listings/{id}', [ListingController::class, 'update']);

// delete listing form
Route::delete('/listings/{id}', [ListingController::class, 'destroy']);

// Single Listing
Route::get('/listings/{id}', [ListingController::class, 'show']);

// Show register/create form
Route::get('/register', [UserController::class, 'create']);

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout']);
