<?php

use Illuminate\Support\Facades\Route;

// ! Fallback
Route::fallback(function () {return view('errors.404');});