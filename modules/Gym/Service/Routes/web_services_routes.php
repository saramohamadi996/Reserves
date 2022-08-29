<?php

use Gym\Service\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Gym\Service\Http\Controllers",
    'middleware' => ['web', 'auth']
], function () {
    Route::get('services', [ServiceController::class,'index'])->name('services.index');

    Route::get('services/create-step-one', [ServiceController::class,'createStepOne'])->name('services.create.step.one');
    Route::post('services/create-step-one', [ServiceController::class,'postCreateStepOne'])->name('services.create.step.one.post');
    Route::get('services/create-step-two', [ServiceController::class,'createStepTwo'])->name('services.create.step.two');
    Route::post('services/create-step-two', [ServiceController::class,'postCreateStepTwo'])->name('services.create.step.two.post');
    Route::get('services/create-step-three', [ServiceController::class,'createStepThree'])->name('services.create.step.three');
    Route::post('services/create-step-three', [ServiceController::class,'postCreateStepThree'])->name('services.create.step.three.post');


    Route::get('services/{service}/edit', [ServiceController::class,'edit'])->name('services.edit');
    Route::post('services/{service}/edit', [ServiceController::class,'update'])->name('services.update');

    Route::get('services/{service}/details', [ServiceController::class,'details'])->name('services.details');
    Route::delete('services/{service}/destroy', [ServiceController::class,'destroy'])->name('services.destroy');
    Route::get('services/toggle/{service}/toggle', [ServiceController::class,'toggle'])->name('services.toggle');
});
