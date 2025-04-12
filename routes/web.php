<?php

    use App\Http\Controllers\Dashboard\DashboardIndexPageController;
    use App\Http\Controllers\Pages\HomePageIndexController;
    use App\Http\Controllers\Profile\ProfileIndexPageController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', HomePageIndexController::class)->name('home');


    Route::get('/dashboard', DashboardIndexPageController::class)->name('dashboard.index');
    Route::get('/profile', ProfileIndexPageController::class)->name('profile.index');


