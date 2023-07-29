<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ValueController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\SubmenuController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Frontend\ReplyController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\PageSettingController;
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\WebsiteLanguageController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\UserPasswordResetController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;





Route::get('website-language/{id}', [HomeController::class, 'language'])->name('website.language');


Route::group(['middleware' => 'language'], function () {

    //<-----------------------> START FRONTEND ROUTE <-----------------------> 

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/page/{slug}', [PageController::class, 'show'])->name('page');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
    Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

    //<-----------------------> Start Blog Route <----------------------->

    Route::get('/blog', [PageController::class, 'blog'])->name('blog');
    Route::get('/blog/detail/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');
    Route::get('/blog/category/{slug}', [PageController::class, 'blogCategory'])->name('blog.category');
    Route::get('/blog/tag/{name}', [PageController::class, 'blogTag'])->name('blog.tag');

    //<-----------------------> Start Comment Route <----------------------->

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/update/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

    //<-----------------------> Start Reply Route <----------------------->

    Route::post('/reply/store', [ReplyController::class, 'store'])->name('reply.store');
    Route::post('/reply/update/{id}', [ReplyController::class, 'update'])->name('reply.update');
    Route::delete('/reply/delete/{id}', [ReplyController::class, 'delete'])->name('reply.delete');

    //<-----------------------> Start Subscriber Route <----------------------->

    Route::post('subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');

    //<-----------------------> START ADMIN ROUTE <-----------------------> 

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){


        //<-----------------------> Start Login Route <-----------------------> 

        Route::get('login', [AdminLoginController::class, 'loginForm'])->name('login.form');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');


        Route::group(['middleware' => 'auth:admin'], function(){


            //<-----------------------> Start Dashboard Route <-----------------------> 

        Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])-> name('dashboard');

        //<-----------------------> Start Menu Route <-----------------------> 

        Route::get('menu/index', [MenuController::class, 'index'])->name('menu.index');
        Route::get('menu/lang/{id}', [MenuController::class, 'lang'])->name('menu.lang');
        Route::get('menu/primary/{id}', [MenuController::class, 'primary'])->name('menu.primary');
        Route::post('menu/store', [MenuController::class, 'store'])->name('menu.store');
        Route::post('menu/order/update', [MenuController::class, 'orderUpdate'])->name('menu.order.update');
        Route::post('menu/status/{id}', [MenuController::class, 'status'])->name('menu.status');
        Route::post('menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('menu/delete/{id}', [MenuController::class, 'delete'])->name('menu.delete');


        //<-----------------------> Start Submenu Route <-----------------------> 

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
            Route::delete('website-language/delete/{id}', [WebsiteLanguageController::class, 'delete'])->name('website-language.delete');


            //<-----------------------> Start Pages Route <-----------------------> 

            Route::get('page/index', [PageController::class, 'index'])->name('page.index');
            Route::get('page/data', [PageController::class, 'getPage'])->name('page.data');
            Route::get('page/create', [PageController::class, 'create'])->name('page.create');
            Route::post('page/store', [PageController::class, 'store'])->name('page.store');
            Route::get('page/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('page/update/{id}', [PageController::class, 'update'])->name('page.update');
            Route::post('page/status/{id}', [PageController::class, 'status'])->name('page.status');
            Route::delete('page/delete/{id}', [PageController::class, 'delete'])->name('page.delete');
            Route::get('page/menu/{id}', [PageController::class, 'menuData'])->name('page.menu.data');


            //<-----------------------> Start Form Route <-----------------------> 

            Route::get('form/index', [FormController::class, 'index'])->name('form.index');
            Route::get('form/data', [FormController::class, 'getForm'])->name('form.data');
            Route::get('form/create', [FormController::class, 'create'])->name('form.create');
            Route::post('form/store', [FormController::class, 'store'])->name('form.store');
            Route::get('form/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
            Route::post('form/update/{id}', [FormController::class, 'update'])->name('form.update');
            Route::post('form/status/{id}', [FormController::class, 'status'])->name('form.status');
            Route::post('form/value/{id}', [FormController::class, 'value'])->name('form.value');
            Route::delete('form/delete/{id}', [FormController::class, 'delete'])->name('form.delete');


            //<-----------------------> Start Value Route <-----------------------> 


            Route::get('value/show/{id}', [ValueController::class, 'show'])->name('value.show');
            Route::get('value/form/index', [ValueController::class, 'formIndex'])->name('value.form.index');
            Route::get('value/form/data', [ValueController::class, 'getValueForm'])->name('value.form.data');
            Route::get('value/file/{file}', [ValueController::class, 'downloadFile'])->name('value.file.download');
            Route::get('value/image/{image}', [ValueController::class, 'downloadImage'])->name('value.image.download');

            
            //<-----------------------> Start Category Route <-----------------------> 


            Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');
            Route::get('category/data', [CategoryController::class, 'getCategory'])->name('category.data');
            Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');


            //<-----------------------> Start Post Route <-----------------------> 


            Route::get('post/index', [PostController::class, 'index'])->name('post.index');
            Route::get('post/data', [PostController::class, 'getPost'])->name('post.data');
            Route::get('post/create', [PostController::class, 'create'])->name('post.create');
            Route::post('post/store', [PostController::class, 'store'])->name('post.store');
            Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
            Route::post('post/update/{id}', [PostController::class, 'update'])->name('post.update');
            Route::delete('post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');


             //<-----------------------> Start User Route <-----------------------> 


            Route::get('user/index', [UserController::class, 'index'])->name('user.index');
            Route::get('user/data', [UserController::class, 'getUser'])->name('user.data');
            Route::get('user/show/{id}', [UserController::class, 'show'])->name('user.show');
            Route::delete('user/delete', [UserController::class, 'delete'])->name('user.delete');


            //<-----------------------> Start Page Setting Route <-----------------------> 

            Route::get('page/setting/home', [PageSettingController::class, 'home'])->name('page.setting.home');
            Route::get('page/setting/home/delete', [PageSettingController::class, 'getHome'])->name('page.setting.home.data');
            Route::get('page/setting/home/create', [PageSettingController::class, 'createHome'])->name('page.setting.home.create');
            Route::post('page/setting/home/store', [PageSettingController::class, 'storeHome'])->name('page.setting.home.store');
            Route::post('page/setting/home/status/{id}', [PageSettingController::class, 'homeStatus'])->name('page.setting.home.status');
            Route::get('page/setting/home/edit/{id}', [PageSettingController::class, 'homeEdit'])->name('page.setting.home.edit');
            Route::post('page/setting/home/update/{id}', [PageSettingController::class, 'homeUpdate'])->name('page.setting.home.update');
            Route::delete('page/setting/home/delete/{id}', [PageSettingController::class, 'homeDelete'])->name('page.setting.home.delete');

            Route::get('page/setting/about', [PageSettingController::class, 'about'])->name('page.setting.about');
            Route::get('page/setting/about/data', [PageSettingController::class, 'getAbout'])->name('page.setting.about.data');
            Route::get('page/setting/about/create', [PageSettingController::class, 'createAbout'])->name('page.setting.about.create');
            Route::post('page/setting/about/store', [PageSettingController::class, 'storeAbout'])->name('page.setting.about.store');
            Route::post('page/setting/about/status/{id}', [PageSettingController::class, 'aboutStatus'])->name('page.setting.about.status');
            Route::get('page/setting/about/edit/{id}', [PageSettingController::class, 'aboutEdit'])->name('page.setting.about.edit');
            Route::post('page/setting/about/update/{id}', [PageSettingController::class, 'aboutUpdate'])->name('page.setting.about.update');
            Route::delete('page/setting/about/delete/{id}', [PageSettingController::class, 'aboutDelete'])->name('page.setting.about.delete');

            Route::get('page/setting/faqs', [PageSettingController::class, 'faqs'])->name('page.setting.faqs');
            Route::get('page/setting/faqs/data', [PageSettingController::class, 'getFaqs'])->name('page.setting.faqs.data');
            Route::get('page/setting/faqs/create', [PageSettingController::class, 'createFaqs'])->name('page.setting.faqs.create');
            Route::post('page/setting/faqs/store', [PageSettingController::class, 'storeFaqs'])->name('page.setting.faqs.store');
            Route::post('page/setting/faqs/status/{id}', [PageSettingController::class, 'FaqsStatus'])->name('page.setting.faqs.status');
            Route::get('page/setting/faqs/edit/{id}', [PageSettingController::class, 'faqsEdit'])->name('page.setting.faqs.edit');
            Route::post('page/setting/faqs/update/{id}', [PageSettingController::class, 'faqsUpdate'])->name('page.setting.faqs.update');
            Route::delete('page/setting/faqs/delete/{id}', [PageSettingController::class, 'faqsDelete'])->name('page.setting.faqs.delete');

            Route::get('page/setting/footer', [PageSettingController::class, 'footer'])->name('page.setting.footer');
            Route::get('page/setting/footer/data', [PageSettingController::class, 'getFooter'])->name('page.setting.footer.data');
            Route::get('page/setting/footer/create', [PageSettingController::class, 'createFooter'])->name('page.setting.footer.create');
            Route::post('page/setting/footer/store', [PageSettingController::class, 'storeFooter'])->name('page.setting.footer.store');
            Route::post('page/setting/footer/status/{id}', [PageSettingController::class, 'footerStatus'])->name('page.setting.footer.status');
            Route::get('page/setting/footer/edit/{id}', [PageSettingController::class, 'footerEdit'])->name('page.setting.footer.edit');
            Route::post('page/setting/footer/update/{id}', [PageSettingController::class, 'footerUpdate'])->name('page.setting.footer.update');
            Route::delete('page/setting/footer/delete/{id}', [PageSettingController::class, 'footerDelete'])->name('page.setting.footer.delete');


            //<-----------------------> Start General Setting Route <----------------------->

            Route::get('general/setting/logo', [GeneralSettingController::class, 'logo'])->name('general.setting.logo');
            Route::post('general/setting/logo/update', [GeneralSettingController::class, 'updateLogo'])->name('general.setting.logo.update');

            Route::get('general/setting/icon', [GeneralSettingController::class, 'icon'])->name('general.setting.icon');
            Route::post('general/setting/icon/update', [GeneralSettingController::class, 'updateIcon'])->name('general.setting.icon.update');

            Route::get('general/setting/social', [GeneralSettingController::class, 'social'])->name('general.setting.social');
            Route::post('general/setting/social/fb/update', [GeneralSettingController::class, 'updateFacebook'])->name('general.setting.social.fb');
            Route::post('general/setting/social/g/update', [GeneralSettingController::class, 'updateGoogle'])->name('general.setting.social.g');

            Route::get('general/setting/captcha', [GeneralSettingController::class, 'captcha'])->name('general.setting.captcha');
            Route::post('general/setting/captcha/update', [GeneralSettingController::class, 'updateCaptcha'])->name('general.setting.captcha.update');


            //<-----------------------> Start Mail Setting <----------------------->

            Route::get('mail', [GeneralSettingController::class, 'mail'])->name('mail');
            Route::post('mail/update', [GeneralSettingController::class, 'updateMail'])->name('mail.update');


            //<-----------------------> Start SEO Route <----------------------->

            Route::get('seo', [GeneralSettingController::class, 'seo'])->name('seo');
            Route::post('seo/update', [GeneralSettingController::class, 'updateSeo'])->name('seo.update');

            //<-----------------------> Start Contact Route <-----------------------> 


            Route::get('contact/index', [ContactController::class, 'index'])->name('contact.index');
            Route::get('contact/data', [ContactController::class, 'getContact'])->name('contact.data');
            Route::delete('contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');


             //<-----------------------> Start Subscriber Route <----------------------->

            Route::get('subscriber/index', [SubscriberController::class, 'index'])->name('subscriber.index');
            Route::get('subscriber/data', [SubscriberController::class, 'getData'])->name('subscriber.data');
            Route::delete('subscriber/delete/{id}', [SubscriberController::class, 'delete'])->name('subscriber.delete');
            


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