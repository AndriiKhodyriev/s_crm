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
    Route::get('/datatablesFindByTicketStatusId/{id}', 'JoinsController@datatablesFindByTicketStatusId');
    Route::post('/datablesFindById', 'JoinsController@datablesFindById');
Route::resource('repairs', 'RepairsController');
	Route::get('/datablesAllRepairs', 'RepairsController@datablesAllRepairs');
    Route::post('/datablesRepairFindById', 'RepairsController@datablesRepairFindById');
    Route::get('/datatablesRepairsFindByTicId/{id}', 'RepairsController@datatablesRepairsFindByTicId');
