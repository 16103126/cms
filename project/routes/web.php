<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\UserPasswordResetController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;







//<-----------------------> START ADMIN ROUTE <-----------------------> 

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){


    //<-----------------------> Start Login Route <-----------------------> 

    Route::get('login', [AdminLoginController::class, 'loginForm'])->name('login.form');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');


    Route::group(['middleware' => 'auth:admin'], function(){


        //<-----------------------> Start Dashboard Route <-----------------------> 

       Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])-> name('dashboard');

    });
     
});



//<-----------------------> START USER ROUTE <-----------------------> 

Route::group(['prefix' => 'user', 'as' => 'user.'], function(){


    //<-----------------------> Start Register Route <-----------------------> 

    Route::get('registration', [UserRegistrationController::class, 'registerForm'])->name('register.form');
    Route::post('registration', [UserRegistrationController::class, 'register'])->name('register');


    //<-----------------------> Start Login Route <-----------------------> 

    Route::get('login', [UserLoginController::class, 'loginForm'])->name('login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('login');
    Route::get('logout', [UserLoginController::class, 'logout'])->name('logout');

    Route::get('login/{provider}', [UserLoginController::class, 'providerRedirect'])->name('provider.login');
    Route::get('login/{provider}/callback', [UserLoginController::class, 'loginWithProvider'])->name('provider.callback');

    Route::get('password/forgot/form', [UserPasswordResetController::class, 'passwordForgotForm'])->name('password.forgot.form');
    Route::post('password/forgot', [UserPasswordResetController::class, 'passwordForgot'])->name('password.forgot');
    Route::get('password/reset/{username}', [UserPasswordResetController::class, 'passwordResetForm'])->name('password.reset.form');
    Route::post('password/reset/{username}', [UserPasswordResetController::class, 'passwordReset'])->name('password.reset');

    Route::get('twofa/form', [UserLoginController::class, 'twoFactorForm'])->name('twofa.form')->middleware('auth:user');
    Route::post('twofa', [UserLoginController::class, 'twoFactor'])->name('twofa')->middleware('auth:user');
    Route::get('resend/code', [UserLoginController::class, 'resendCode'])->name('resend.code')->middleware('auth:user');

    Route::group(['middleware' => 'auth:user', 'middleware' => '2Fa'], function(){


        //<-----------------------> Start Dashboard Route <-----------------------> 

       Route::get('dashboard', [DashboardController::class, 'dashboard'])-> name('dashboard');

       Route::get('account/profile', [AccountController::class, 'profile'])->name('profile');
       Route::get('profile/data', [AccountController::class, 'profileData'])->name('profile.data');
       Route::post('profile/update/{id}', [AccountController::class, 'profileUpdate'])->name('profile.update');
       Route::post('profile/image/update/{id}', [AccountController::class, 'profileImageUpdate'])->name('profile.image.update');
       Route::post('account/deactivate/{id}', [AccountController::class, 'accountDeactivate'])->name('account.deactivate');

       Route::get('account/password/reset', [AccountController::class, 'PasswordResetForm'])->name('account.password.reset.form');
       Route::post('account/password/reset/{id}', [AccountController::class, 'PasswordReset'])->name('account.password.reset');

       Route::get('account/twofa', [AccountController::class, 'twofaForm'])->name('account.twofa.form');
       Route::post('account/twofa/{id}', [AccountController::class, 'twofa'])->name('account.twofa');

       Route::get('account/profile/show/{id}', [AccountController::class, 'profileShow'])->name('account.profile.show');

       Route::get('country', [AccountController::class, 'country'])->name('country');
       Route::get('state/{id}', [AccountController::class, 'state'])->name('state');
       Route::get('city/{id}', [AccountController::class, 'city'])->name('city');

    });
    
});
