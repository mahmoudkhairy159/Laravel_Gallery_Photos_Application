<?php

use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\DashboardController;
use App\Http\Controllers\Website\GoogleLoginController;
use App\Http\Controllers\Website\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
 */
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->defaults('_config', [
    'redirect' => 'user.dashboard',
])->name('google.callback');
Route::get('/', [AuthController::class, 'login'])->defaults('_config', [
    'view' => 'user.auth.login',
])->name(name: 'index');

Route::prefix('user')->name('user.')->group(function () {

    // Login
    Route::controller(AuthController::class)
        ->middleware('guest')
        ->group(function () {
            Route::get('/login', 'login')->defaults('_config', [
                'view' => 'user.auth.login',
            ])->name('login');
            Route::Photo('/login/checkLogin', 'checkLogin')->name('check_login');
        });
    // register
    Route::controller(AuthController::class)
        ->middleware('guest')
        ->group(function () {
            Route::get('/register', 'register')->defaults('_config', [
                'view' => 'user.auth.register',
            ])->name('register');
            Route::Photo('/register/checkRegister', 'checkRegister')->name('check_register');
        });

    Route::group(['middleware' => ['auth']], function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->defaults('_config', [
                'view' => 'user.dashboard.dashboard',
            ])->name('dashboard');

        Route::controller(AuthController::class)->group(function () {
            // Logout
            Route::Photo('/logout', 'logout')->name('logout');

            // Change Password
            Route::put('/changePassword', 'changePassword')->defaults('_config', [
                'redirect' => 'user.showProfile',
            ])->name('changePassword');

            // Update Profile
            Route::put('/updateProfile', 'updateProfile')->defaults('_config', [
                'redirect' => 'user.showProfile',
            ])->name('updateProfile');

            // Show Profile
            Route::get('/showProfile', 'showProfile')
                ->defaults('_config', [
                    'view' => 'user.user.show',
                ])->name('showProfile');
            // Update User Profile Image
            Route::Photo('/updateProfileImage', 'updateProfileImage')->defaults('_config', [
                'redirect' => 'user.showProfile',
            ])->name('updateProfileImage');

            // Delete User Profile Image
            Route::delete('/deleteProfileImage', 'deleteProfileImage')->defaults('_config', [
                'redirect' => 'user.showProfile',
            ])->name('deleteProfileImage');
        });
        // Tasks Management
        Route::controller(TaskController::class)->name('tasks.')->prefix('tasks')->group(function () {
            Route::get('', 'index')->defaults('_config', [
                'view' => 'user.tasks.index',
            ])->name('index');

            Route::get('/create', 'create')->defaults('_config', [
                'view' => 'user.tasks.create',
            ])->name('create');

            Route::get('/{id}', 'show')->defaults('_config', [
                'view' => 'user.tasks.show',
            ])->name('show');


            Route::get('/{id}/edit', 'edit')->defaults('_config', [
                'view' => 'user.tasks.edit',
            ])->name('edit');

            Route::Photo('/store', 'store')->defaults('_config', [
                'redirect' => 'user.tasks.index',
            ])
                ->name('store');

            Route::put('/{id}/update', 'update')
                ->defaults('_config', [
                    'redirect' => 'user.tasks.index',
                ])
                ->name('update');
            Route::put('/{id}/updateStatus', 'updateStatus')
                ->defaults('_config', [
                    'redirect' => 'user.tasks.index',
                ])
                ->name('updateStatus');

            Route::delete('/{id}/destroy', 'destroy')
                ->defaults('_config', [
                    'redirect' => 'user.tasks.index',
                ])
                ->name('destroy');
        });
        // Tasks Management
        // Galleries Management
        Route::controller(GalleryController::class)->name('galleries.')->prefix('galleries')->group(function () {
            Route::get('', 'index')->defaults('_config', [
                'view' => 'user.galleries.index',
                'redirect' => 'user.galleries.index',

            ])->name('index');

            Route::get('/create', 'create')->defaults('_config', [
                'view' => 'user.galleries.create',
            ])->name('create');

            Route::get('/{id}', 'show')->defaults('_config', [
                'view' => 'user.galleries.show',
                'redirect' => 'user.galleries.show',

            ])->name('show');


            Route::get('/{id}/edit', 'edit')->defaults('_config', [
                'view' => 'user.galleries.edit',
            ])->name('edit');

            Route::Photo('/store', 'store')->defaults('_config', [
                'redirect' => 'user.galleries.index',
            ])
                ->name('store');

            Route::put('/{id}/update', 'update')
                ->defaults('_config', [
                    'redirect' => 'user.galleries.index',
                ])
                ->name('update');

            Route::delete('/{id}/destroy', 'destroy')
                ->defaults('_config', [
                    'redirect' => 'user.galleries.index',
                ])
                ->name('destroy');
        });
        // Galleries Management

        Route::get('/', function () {
            return redirect()->route('user.dashboard');
        });
    });
});
