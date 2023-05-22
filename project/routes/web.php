<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\SubmenuController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\WebsiteLanguageController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\UserPasswordResetController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;





Route::get('website-language/{id}', [HomeController::class, 'language'])->name('website.language');


Route::group(['middleware' => 'language'], function () {
    //<-----------------------> START FRONTEND ROUTE <-----------------------> 

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //<-----------------------> START ADMIN ROUTE <-----------------------> 

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){


        //<-----------------------> Start Login Route <-----------------------> 

        Route::get('login', [AdminLoginController::class, 'loginForm'])->name('login.form');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');


        Route::group(['middleware' => 'auth:admin'], function(){


            //<-----------------------> Start Dashboard Route <-----------------------> 

        Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])-> name('dashboard');

        //<-----------------------> Start Menu Builder Route <-----------------------> 

        Route::get('menu/index', [MenuController::class, 'index'])->name('menu.index');
        Route::get('menu/lang/{id}', [MenuController::class, 'lang'])->name('menu.lang');
        Route::get('menu/primary/{id}', [MenuController::class, 'primary'])->name('menu.primary');
        Route::post('menu/store', [MenuController::class, 'store'])->name('menu.store');
        Route::post('menu/order/update', [MenuController::class, 'orderUpdate'])->name('menu.order.update');
        Route::post('menu/status/{id}', [MenuController::class, 'status'])->name('menu.status');
        Route::post('menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('menu/delete/{id}', [MenuController::class, 'delete'])->name('menu.delete');

        
        Route::post('submenu/store', [SubmenuController::class, 'store'])->name('submenu.store');
        Route::post('submenu/status/{id}', [SubmenuController::class, 'status'])->name('submenu.status');
        Route::post('submenu/order/update', [SubmenuController::class, 'orderUpdate'])->name('submenu.order.update');
        Route::post('submenu/update/{id}', [SubmenuController::class, 'update'])->name('submenu.update');
        Route::delete('submenu/delete/{id}', [SubmenuController::class, 'delete'])->name('submenu.delete');


        //<-----------------------> Start Account Setting Route <-----------------------> 

        Route::get('account/profile', [AdminAccountController::class, 'profile'])->name('profile');
        Route::get('profile/data', [AdminAccountController::class, 'profileData'])->name('profile.data');
        Route::post('profile/update/{id}', [AdminAccountController::class, 'profileUpdate'])->name('profile.update');
        Route::post('profile/image/update/{id}', [AdminAccountController::class, 'profileImageUpdate'])->name('profile.image.update');
        Route::get('account/profile/show/{id}', [AdminAccountController::class, 'profileShow'])->name('account.profile.show');
        
        Route::get('account/password/reset', [AdminAccountController::class, 'PasswordResetForms'])->name('account.password.reset.form');
        Route::post('account/password/reset/{id}', [AdminAccountController::class, 'PasswordReset'])->name('account.password.reset');

        Route::get('country', [AdminAccountController::class, 'country'])->name('country');
        Route::get('state/{id}', [AdminAccountController::class, 'state'])->name('state');
        Route::get('city/{id}', [AdminAccountController::class, 'city'])->name('city');

        
            //<-----------------------> Start Admin Language Setting Route <-----------------------> 

            Route::get('admin-language/index', [AdminLanguageController::class, 'index'])->name('admin-language.index');
            Route::get('admin-langage/data', [AdminLanguageController::class, 'getLanguage'])->name('admin-language.data');
            Route::get('admin-language/create', [AdminLanguageController::class, 'create'])->name('admin-language.create');
            Route::post('admin-language/store', [AdminLanguageController::class, 'store'])->name('admin-language.store');
            Route::post('admin-language/status/{id}', [AdminLanguageController::class, 'status'])->name('admin-language.status');
            Route::get('admin-language/edit/{id}', [AdminLanguageController::class, 'edit'])->name('admin-language.edit');
            Route::post('admin-language/update/{id}', [AdminLanguageController::class, 'update'])->name('admin-language.update');
            Route::delete('admin-language/delete/{id}', [AdminLanguageController::class, 'delete'])->name('admin-language.delete');


            //<-----------------------> Start Website Language Setting Route <-----------------------> 

            Route::get('website-language/create', [WebsiteLanguageController::class, 'create'])->name('website-language.create');
            Route::post('website-language/store', [WebsiteLanguageController::class, 'store'])->name('website-language.store');
            Route::get('website-language/index', [WebsiteLanguageController::class, 'index'])->name('website-language.index');
            Route::get('website-langage/data', [WebsiteLanguageController::class, 'getLanguage'])->name('website-language.data');
            Route::post('website-language/status/{id}', [WebsiteLanguageController::class, 'status'])->name('website-language.status');
            Route::get('website-language/edit/{id}', [WebsiteLanguageController::class, 'edit'])->name('website-language.edit');
            Route::post('website-language/update/{id}', [WebsiteLanguageController::class, 'update'])->name('website-language.update');
            Route::delete('website-language/delete/{id}', [WebsiteLanguageController::class, 'delete'])->name('website-language.delete');


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


        //<-----------------------> Start Account setting Route <-----------------------> 

        Route::get('account/profile', [AccountController::class, 'profile'])->name('profile');
        Route::get('profile/data', [AccountController::class, 'profileData'])->name('profile.data');
        Route::post('profile/update/{id}', [AccountController::class, 'profileUpdate'])->name('profile.update');
        Route::get('account/profile/show/{id}', [AccountController::class, 'profileShow'])->name('account.profile.show');
        Route::post('profile/image/update/{id}', [AccountController::class, 'profileImageUpdate'])->name('profile.image.update');
        Route::post('account/deactivate/{id}', [AccountController::class, 'accountDeactivate'])->name('account.deactivate');

        Route::get('account/password/reset', [AccountController::class, 'PasswordResetForm'])->name('account.password.reset.form');
        Route::post('account/password/reset/{id}', [AccountController::class, 'PasswordReset'])->name('account.password.reset');

        Route::get('account/twofa', [AccountController::class, 'twofaForm'])->name('account.twofa.form');
        Route::post('account/twofa/{id}', [AccountController::class, 'twofa'])->name('account.twofa');

        Route::get('country', [AccountController::class, 'country'])->name('country');
        Route::get('state/{id}', [AccountController::class, 'state'])->name('state');
        Route::get('city/{id}', [AccountController::class, 'city'])->name('city');

        });
        
    });
});