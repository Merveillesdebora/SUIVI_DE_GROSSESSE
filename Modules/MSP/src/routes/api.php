<?php

use Illuminate\Support\Facades\Route;
use DTIC\MSP\App\Http\Controllers\Api\IndicateurController;

Route::get('/indicateurs', [IndicateurController::class, 'indicateurs']);