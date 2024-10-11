<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::controller(ProjectsController::class)->group(function () {
    Route::get('/', 'index')->name('projects.index');
    Route::get('/project/{project}', 'show')->name('projects.show');
});

