<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */
Route::get('/', function ()
{
    return View::make('hello');


});

Route::get('suppliers','CompaniesController@indexSuppliers');
Route::post('suppliers','CompaniesController@indexSuppliers');
Route::get('clients','CompaniesController@indexClients');
Route::post('clients','CompaniesController@indexClients');
Route::get('contacts','CompaniesController@indexContacts');
Route::post('contacts','CompaniesController@indexContacts');
Route::post('allcompanies','CompaniesController@indexAll');
Route::get('allcompanies','CompaniesController@indexAll');
Route::resource('companies','CompaniesController');
Route::post('allbuyers','BuyersController@indexAll');
Route::resource('buyers','BuyersController');
Route::resource('companytype','CompanyTypesController');
Route::get('transporters/ajax','TransportersController@listAjax');
Route::post('alltransporters','TransportersController@indexAll');
Route::resource('transporters','TransportersController');
Route::get('transporters/{transporter_fk}/vehicles','VehiclesController@index');
Route::post('transporters/{transporter_fk}/vehicles','VehiclesController@indexAll');
Route::get('vehicles/create/{id}', 'VehiclesController@create');
Route::get('vehicles/ajax/{transporter_fk}/{type_fk}','VehiclesController@listAjax');
Route::resource('vehicles','VehiclesController');
Route::get('vehicletype/ajax','VehicleTypesController@listAjax');
Route::resource('vehicletype','VehicleTypesController');

// Route::get('closedorders','OrdersController@indexClosed');
// Route::post('closedorders','OrdersController@indexClosed');
// Route::get('openorders','OrdersController@indexOpen');
// Route::post('openorders','OrdersController@indexOpen');
// Route::get('cancelledorders','OrdersController@indexCancelled');
// Route::post('cancelledorders','OrdersController@indexCancelled');



Route::get('orders/pdf/{id}','OrdersController@pdf');
Route::post('orders/list','OrdersController@orderList');
Route::get('orders/list','OrdersController@orderList');
Route::resource('orders','OrdersController');

Route::post('reports/transporter','StandardReportController@indexTransporter');
Route::get('reports/transporter','StandardReportController@indexTransporter');
Route::post('reports/buyer','StandardReportController@indexBuyer');
Route::get('reports/buyer','StandardReportController@indexBuyer');
Route::resource('reports','StandardReportController');

Route::resource('users','UsersController');
Route::resource('accesslevels','AccessLevelsController');
