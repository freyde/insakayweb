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

Route::get('/', 'firebaseController@homeManager');
// 
Route::post('/logout', 'sessionController@logout');
Route::post('/verify', 'sessionController@save');
//
Route::get('/conductors', 'firebaseController@listConductors');
Route::get('/buses', 'firebaseController@listBuses');
//
Route::post('/addconductor', 'firebaseController@addConductor');
Route::post('/addbus', 'firebaseController@addBus');
//
Route::get('/routes', 'firebaseController@displayRoutes');
Route::get('/routes/addroute', 'firebaseController@viewAddRoute');
// Route::post('/routes/addroutes', 'firebaseController@addRoute');
Route::get('/routes/manage/{routeid}', 'firebaseController@manageRoute');
Route::post('/routes/addlandmark', 'firebaseController@addLandmark');
//
Route::get('/admin', 'firebaseController@adminHomemanager');
Route::post('/verifyadmin', 'sessionController@adminsave');
//
Route::get('/admin/operators', 'adminController@listOperators');
Route::post('/admin/addoperator', 'adminController@addOperatorAccount');
Route::get('/admin/manage/{operator}', 'adminController@displayOperator');

Route::get('/routetest', 'firebaseController@index');





// Route::get('/conductors', function () {
//     return view('conductors')->with('uid', session()->get('uid'));
// });















Route::get('/test', 'firebaseController@index');

Route::get('ajaxRequest', 'HomeController@ajaxRequest');

Route::post('ajaxRequest', 'HomeController@ajaxRequestPost');