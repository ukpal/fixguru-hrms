<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', 'dashboard');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('all', 'index')->name('users.all')->middleware('permission:view users');
            Route::get('create', 'create')->name('users.create')->middleware('permission:edit users');
            Route::post('store', 'store')->name('users.store')->middleware('permission:edit users');
            Route::get('edit/{employee}', 'edit')->name('users.edit')->middleware('permission:edit users');
            Route::post('update/{employee}', 'update')->name('users.update')->middleware('permission:edit users');
            Route::get('show/{employee}/{type}', 'show')->name('users.show')->middleware('permission:edit users');
            Route::get('getAccess/{employee}', 'getAccess')->name('users.getAccess')->middleware('permission:edit users');
            Route::post('setAccess/', 'setAccess');
        });
    });

    Route::prefix('holidays')->group(function () {
        Route::controller(HolidayController::class)->group(function () {
            Route::get('all', 'index')->name('holidays.all')->middleware('permission:view holidays');
            Route::get('create', 'create')->name('holidays.create')->middleware('permission:edit holidays');
            Route::post('store', 'store')->name('holidays.store')->middleware('permission:edit holidays');
            Route::get('edit/{holiday}', 'edit')->name('holidays.edit')->middleware('permission:edit holidays');
            Route::post('update/{holiday}', 'update')->name('holidays.update')->middleware('permission:edit holidays');
            Route::get('delete/{holiday}', 'destroy')->name('holidays.delete')->middleware('permission:edit holidays');
        });
    });

    Route::prefix('employees')->group(function () {
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('all', 'index')->name('employees.all')->middleware('permission:view employees');
            Route::get('create', 'create')->name('employees.create')->middleware('permission:edit employees');
            Route::post('store', 'store')->name('employees.store')->middleware('permission:edit employees');
            Route::get('edit/{employee}', 'edit')->name('employees.edit')->middleware('permission:edit employees');
            Route::post('update/{employee}/personal-details', 'update')->middleware('permission:edit employees');
            Route::post('update/{employee}/emergency-contact', 'updateEmergencyContact')->middleware('permission:edit employees');
            Route::post('update/{employee}/background-verification', 'updateBackgroundVerification')->middleware('permission:edit employees');
            Route::post('update/{employee}/employee-documents', 'updateEmpDocuments')->middleware('permission:edit employees');
            Route::get('delete/{employee}', 'destroy')->name('employees.delete')->middleware('permission:edit employees');
            Route::get('show/{id}/{type}', 'show')->name('employees.show')->middleware('permission:edit employees');
        });
    });

    Route::prefix('profile')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('profile.index');
            Route::post('/update', 'update')->name('profile.update');
        });
    });

    Route::prefix('departments')->group(function () {
        Route::controller(DepartmentController::class)->group(function () {
            Route::get('all', 'index')->name('departments.all')->middleware('permission:view departments');
            Route::get('create', 'create')->name('departments.create')->middleware('permission:edit departments');
            Route::post('store', 'store')->name('departments.store')->middleware('permission:edit departments');
            Route::get('edit/{department}', 'edit')->name('departments.edit')->middleware('permission:edit departments');
            Route::post('update/{department}', 'update')->name('departments.update')->middleware('permission:edit departments');
            Route::get('delete/{department}', 'destroy')->name('departments.delete')->middleware('permission:edit departments');
            Route::get('show/{id}/{type}', 'show')->name('departments.show')->middleware('permission:edit departments');
        });
    });
});
