<?php

use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * For check roles (permission access) for each route (function_code),
 * required each route have to a name which used to the
 * check in middleware permission and this is defined in Module, Function Management
 * @author: ThangNH
 * @created_at: 2021/10/01
 */

Route::namespace('FrontEnd')->group(function () {

    Route::get('/sitemap.xml', 'SitemapXmlController@index')->name('frontend.sitemap');

    Route::get('/', 'HomeController@index')->name('frontend.home');
    Route::get('/gioi-thieu', 'AboutusController@index')->name('frontend.aboutus');

    // Contact
    Route::match(array('GET', 'POST'), 'dai-ly', 'ContactController@branch')->name('frontend.branch');

    Route::get('lien-he', 'ContactController@index')->name('frontend.contact');
    Route::post('contact', 'ContactController@store')->name('frontend.contact.store');
    // Order
    Route::post('order-service', 'OrderController@storeOrderService')->name('frontend.order.store.service');
    // Cart
    Route::post('add-to-cart', 'OrderController@addToCart')->name('frontend.order.add_to_cart');
    Route::get('gio-hang', 'OrderController@cart')->name('frontend.order.cart');
    Route::patch('update-cart', 'OrderController@updateCart')->name('frontend.order.cart.update');
    Route::delete('remove-from-cart', 'OrderController@removeCart')->name('frontend.order.cart.remove');
    Route::post('order-product', 'OrderController@storeOrderProduct')->name('frontend.order.store.product');
    Route::post('review-product', 'OrderController@storeReviewProduct')->name('frontend.review.store.product');


    // User CTV route
    // Route::get('/login', 'UserController@loginForm')->name('frontend.login');
    Route::post('/login', 'UserController@login')->name('frontend.login.post');
    Route::post('/signup', 'UserController@signup')->name('frontend.signup.post');
    Route::get('/verify/{id}/{code?}', 'UserController@verifyAccount')->name('frontend.signup.active');





    Route::group(['prefix' => 'user', 'middleware' => ['auth:web']], function () {

        Route::get('/', 'UserController@index')->name('frontend.user');

        Route::get('/logout', 'UserController@logout')->name('frontend.logout');
    });

    // Filter
    Route::get('search', function (Request $request) {
        $params = $request->all();
        // $slug = 'tu-khoa' . ContentService::getSlugSearch($params);
        $slug = $request->get('keyword') ?? '';
        return redirect()->route('frontend.search', ['slug' => $slug])->with(['params' => $params]);
    })->name('frontend.search.index');
    // search to slug
    Route::get('tim-kiem', 'SearchController@filter')->name('frontend.search');
    Route::get('all', 'AllController@filter')->name('frontend.all');

    // Google
    

    // Xử lý phần route cho chi tiết chung trong bảng posts

    Route::get('{alias_category}', 'CmsController@postCategory')->name('frontend.cms.taxonomy');
    Route::get('{alias}', 'CmsController@postCategory')->name('frontend.page');

    Route::get('{alias_category}/{alias?}', 'CmsController@detail')->name('frontend.cms.detail');
});
