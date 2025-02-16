<?php

use App\Livewire\LeadStatusUpdater;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/preview-email', function () {
    $content = "Hello Name, we noticed you're interested in dental implants. Let us know if you have any questions!";

    return new App\Mail\SalesStageEmail($content);
});

Route::get('/update-lead-status', LeadStatusUpdater::class);
