<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'IndexController@index');

Route::resource('joins', 'JoinsController');
    Route::get('/datablesAllJoins', 'JoinsController@datablesAllJoins');
    Route::get('/datatablesFindByTicketStatusId/{id}/{cityID}', 'JoinsController@datatablesFindByTicketStatusId');
    Route::get('/datatablesFindByCityId/{id}', 'JoinsController@datatablesFindByCityId');
    Route::post('/datablesFindById', 'JoinsController@datablesFindById');
    Route::post('/joins_cliens', 'JoinsController@joinsClients');
    Route::post('/logJoin', 'JoinsController@logJoin');
Route::resource('repairs', 'RepairsController');
	Route::get('/datablesAllRepairs', 'RepairsController@datablesAllRepairs');
    Route::post('/datablesRepairFindById', 'RepairsController@datablesRepairFindById');
    Route::get('/datatablesRepairCityId/{id}', 'RepairsController@datatablesRepairCityId');
    Route::get('/datatablesRepairsFindByTicId/{id}/{cityID}', 'RepairsController@datatablesRepairsFindByTicId');
Route::resource('cities', 'CitiesController');
    Route::post('/citychid', 'CitiesController@citychid'); //взять инфу по городу по ИД
Route::resource('statuses', 'StatusesController');
Route::resource('users', 'UsersController');
// Route::get('/users', 'UsersController@index');
    Route::post('/findUserId', 'UsersController@getUser');  
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('snmp', 'SNMPController');
	Route::get('/snmp/{oltIP}/{onuMAC}', 'SNMPController@getONUInfo');
	Route::post('/snmp/getONUInfo', 'SNMPController@getONUInfo');
	Route::get('/snmp', 'SNMPController@index');
Route::resource('abons', 'AbonsController');
    Route::get('/datatablesFindCityIDBase/{id}/{type_con}', 'AbonsController@datatablesFindCityIDBase'); //Выборка по городу + тип подключения
    Route::get('/datatablesFindTConIDBase/{id}/{city_id}', 'AbonsController@datatablesFindTConIDBase'); // Выборка по типу подключения по выбранному городу
    Route::post('/datatablesFindID', 'AbonsController@datatablesFindID'); //взять инфу по ИД
Route::get('/finance', 'FinancialreportsController@index');
    Route::post('/finance_key', 'FinancialreportsController@report');