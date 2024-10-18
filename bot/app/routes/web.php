<?php

use App\Core\Router\Route;
use App\Http\Controller;



Route::get('some', Controller::class, 'index');
Route::get('test_bot', Controller::class, 'testBot');