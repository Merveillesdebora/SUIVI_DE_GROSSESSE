<?php

use DTIC\MSP\App\Http\Controllers\Api\AccroissementController;
use DTIC\MSP\App\Http\Controllers\Api\AnnuelController;
use Illuminate\Support\Facades\Route;
use DTIC\MSP\App\Http\Controllers\Api\IndicateurController;
use DTIC\MSP\app\Models\TauxAccroissement;

Route::get('/indicateurs', [IndicateurController::class, 'indicateurs']);

Route::prefix("indicateurs")->controller(IndicateurController::class)->group(function () {
    Route::get("/", "indicateurs");
    Route::post("create", "create");
    Route::patch("{id}/update", "update");
    Route::delete("{id}/destroy", "destroy");
    Route::get("{id}/show", "findOne");
});

Route::prefix("accroissements")->controller(AccroissementController::class)->group(function () {
    Route::get("/", "accroissements");
    Route::post("create", "create");
    Route::patch("{id}/update", "update");
    Route::delete("{id}/destroy", "destroy");
    Route::get("{id}/show", "findOne");
});

Route::prefix("annuels")->controller(AnnuelController::class)->group(function () {
    Route::get("/", "annuels");
    Route::post("create", "create");
    Route::patch("{id}/update", "update");
    Route::delete("{id}/destroy", "destroy");
    Route::get("{id}/show", "findOne");
});
