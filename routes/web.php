<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Mail\MyTestEmail;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Mail;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/', 'HomeController@index')->name('index');
    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
    Route::post('/processform',[FormController::class,'getregister'] );

    // Route::post('/processform', [FormController::class, 'processForm']);

    
   Route::get('/testroute',function(){
    $name="Funny coder";

    Mail::to('demomailtrap.com')->send(new MyTestEmail($name)
);
   });

   
    
});
