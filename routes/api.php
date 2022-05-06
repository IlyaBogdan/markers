<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all', [APIController::class, 'allMarkers']);
Route::get('/find/{mobile}', [APIController::class, 'find']);
Route::put('/add-marker', [APIController::class, 'add']);
Route::delete('/delete-marker/{id}', [APIController::class, 'delete']);