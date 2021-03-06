<?php

use CMS\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('posts', [PostController::class, 'all']);
Route::get('post/{id}', [PostController::class, 'retrieve']);