<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum','abilities:can-update,can-create')->get('/user', function () {

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('Test token')->plainTextToken;
    return response()->json($token,200);

});

// 20|2gz8NNBK3ARMcmEBzxeHviDCiBh4UjUajJloH1oI