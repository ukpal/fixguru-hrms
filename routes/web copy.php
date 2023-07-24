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
            Route::get('all', 'index')->name('users.all');
            // Route::get('all', 'index')->name('users.all')->middleware('checkAccess:users,view');
            Route::get('create', 'create')->name('users.create')->middleware('checkAccess:users,edit');
            Route::post('store', 'store')->name('users.store')->middleware('checkAccess:users,edit');
            Route::get('edit/{employee}', 'edit')->name('users.edit')->middleware('checkAccess:users,edit');
            Route::post('update/{employee}', 'update')->name('users.update')->middleware('checkAccess:users,edit');
            Route::get('show/{employee}/{type}', 'show')->name('users.show')->middleware('checkAccess:users,edit');
            Route::get('getAccess/{employee}', 'getAccess')->name('users.getAccess')->middleware('checkAccess:users,edit');
            Route::post('setAccess/', 'setAccess')->middleware('checkAccess:users,edit');
        });
    });

    Route::prefix('holidays')->group(function () {
        Route::controller(HolidayController::class)->group(function () {
            Route::get('all', 'index')->name('holidays.all')->middleware('checkAccess:holidays,view');
            Route::get('create', 'create')->name('holidays.create')->middleware('checkAccess:holidays,edit');
            Route::post('store', 'store')->name('holidays.store')->middleware('checkAccess:holidays,edit');
            Route::get('edit/{holiday}', 'edit')->name('holidays.edit')->middleware('checkAccess:holidays,edit');
            Route::post('update/{holiday}', 'update')->name('holidays.update')->middleware('checkAccess:holidays,edit');
            Route::get('delete/{holiday}', 'destroy')->name('holidays.delete')->middleware('checkAccess:holidays,edit');
        });
    });

    Route::prefix('employees')->group(function () {
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('all', 'index')->name('employees.all')->middleware('checkAccess:employees,edit');
            Route::get('create', 'create')->name('employees.create')->middleware('checkAccess:employees,edit');
            Route::post('store', 'store')->name('employees.store')->middleware('checkAccess:employees,edit');
            Route::get('edit/{employee}', 'edit')->name('employees.edit')->middleware('checkAccess:employees,edit');
            Route::post('update/{employee}/personal-details', 'update')->middleware('checkAccess:employees,edit');
            Route::post('update/{employee}/emergency-contact', 'updateEmergencyContact')->middleware('checkAccess:employees,edit');
            Route::post('update/{employee}/background-verification', 'updateBackgroundVerification')->middleware('checkAccess:employees,edit');
            Route::post('update/{employee}/employee-documents', 'updateEmpDocuments')->middleware('checkAccess:employees,edit');
            Route::get('delete/{employee}', 'destroy')->name('employees.delete')->middleware('checkAccess:employees,edit');
            Route::get('show/{id}/{type}', 'show')->name('employees.show')->middleware('checkAccess:employees,edit');
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
            Route::get('all', 'index')->name('departments.all')->middleware('checkAccess:departments,edit');
            Route::get('create', 'create')->name('departments.create')->middleware('checkAccess:departments,edit');
            Route::post('store', 'store')->name('departments.store')->middleware('checkAccess:departments,edit');
            Route::get('edit/{department}', 'edit')->name('departments.edit')->middleware('checkAccess:departments,edit');
            Route::post('update/{department}', 'update')->name('departments.update')->middleware('checkAccess:departments,edit');
            Route::get('delete/{department}', 'destroy')->name('departments.delete')->middleware('checkAccess:departments,edit');
            Route::get('show/{id}/{type}', 'show')->name('departments.show')->middleware('checkAccess:departments,edit');
        });
    });
});
