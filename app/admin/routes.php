<?php

use Admin\Controllers\Reviews;
use Admin\Requests\Reservation;
use Http\Message\Authentication;

App::before(function () {
    /*
     * Register Admin app routes
     *
     * The Admin app intercepts all URLs
     * prefixed with /admin.
     */




    Route::group([
        'middleware' => ['web'],
        'prefix' => config('system.adminUri', 'admin'),
    ], function () {
        // Register Assets Combiner routes
        Route::any(config('system.assetsCombinerUri', '_assets').'/{asset}', 'System\Classes\Controller@combineAssets');

        // Other pages
        Route::any('{slug}', 'System\Classes\Controller@runAdmin')->where('slug', '(.*)?');
    });

    Route::group([
        'middleware' => ['web'],
        'prefix' => config('system.apiUri', 'api'),
    ], function () {
        // Register Assets Combiner routes
        Route::any(config('system.assetsCombinerUri', '_assets').'/{asset}', 'System\Classes\Controller@combineAssets');

    /* API pages */

        // Authentication user
        Route::post('login', 'Admin\Controllers\Rest\UsersApi@login');
        Route::get('decode', 'Admin\Controllers\Rest\UsersApi@decode');
        Route::post('register', 'Admin\Controllers\Rest\UsersApi@register');
        Route::post('address', 'Admin\Controllers\Rest\UsersApi@setaddress');
        Route::get('addresslist', 'Admin\Controllers\Rest\UsersApi@getaddress');
        // get list front "menu, cat, banner"
        Route::get('banners', 'Admin\Controllers\Rest\BannersApi@getlist');
        Route::get('menulist', 'Admin\Controllers\Rest\MenusApi@getList');
        Route::get('menupoint', 'Admin\Controllers\Rest\MenusApi@menupoint');
        Route::get('abc', 'Admin\Controllers\Rest\MenusApi@abc');
        Route::get('categorieses', 'Admin\Controllers\Rest\CategoriesApi@getlist');
        Route::get('mealtimes', 'Admin\Controllers\Rest\MealtimesApi@getlist');
        
        Route::get('customerlist', 'Admin\Controllers\Rest\UsersApi@getlistcus');
        Route::get('location', 'Admin\Controllers\Rest\LocationsApi@getlist');
        Route::get('pages', 'Admin\Controllers\Rest\PagesApi@getlist');
        // Reservation
        Route::get('reservationlist', 'Admin\Controllers\Rest\ReservationApi@getlist');
        Route::post('booking', 'Admin\Controllers\Rest\ReservationApi@booking');
        // make order 
        Route::get('orderList', 'Admin\Controllers\Rest\OrdersApi@getList');
        Route::post('makeorder', 'Admin\Controllers\Rest\OrdersApi@postData');
        // Reviews
        Route::get('reviews', 'Admin\Controllers\Rest\ReviewsApi@getlist');
        Route::post('postreviews', 'Admin\Controllers\Rest\ReviewsApi@postreviews');
        //Menu Point
        Route::get('menupoint', 'Admin\Controllers\Rest\MenuPointApi@getlist');
        Route::get('pointlist', 'Admin\Controllers\Rest\MenuPointApi@pointlist');

    
        Route::get('test', 'Admin\Controllers\Rest\TestApi@test');
        
    });
    

    // Admin entry point
    Route::any(config('system.adminUri', 'admin'), 'System\Classes\Controller@runAdmin');
});