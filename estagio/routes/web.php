<?php

use App\Http\Controllers\GalaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});

Route::post('/encher', [GalaoController::class , 'encher'])->name('encher');

