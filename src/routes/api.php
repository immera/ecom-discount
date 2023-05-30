<?php

use Illuminate\Support\Facades\Route;

if (app() instanceof \Illuminate\Foundation\Application) {
    Route::get('/payment/instances', );
} else {
    $this->app->router->get('/payment/instances', );
}