<?php

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

Route::get('/', 'views\front\HomeController@home')->name('home');
Route::post('report', 'views\front\ReportController@save')->name('report.save');
Route::get('checkout', 'views\front\PaymentController@checkout')->name('checkout');
Route::post('checkout', 'views\front\PaymentController@pay')->name('pay');
Route::get('pdfs/{name}', 'views\front\HomeController@pdfs')->name('pdfs');
Route::get('thankyou', 'views\front\PaymentController@thankyou')->name('thankyou');
Route::get('reports/{slug}', 'views\front\ReportController@show')->name('report');
Route::get('contact', 'views\front\PageController@contact')->name('contact');
Route::post('contact', 'views\front\PageController@contactForm')->name('contact.form');
