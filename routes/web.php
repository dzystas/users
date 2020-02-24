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

Route::get('/', function ()
{
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Users', 'as' => 'users.', 'prefix' => 'users'], function ()
    {
        Route::group(['as' => 'tree.', 'prefix' => 'tree'], function ()
        {
            Route::get('/index', 'TreeController@index')->name('index');
            Route::get('/get_data', 'TreeController@getData')->name('get_data');

            Route::post('/create_update', 'TreeController@createUpdate')->name('create_update');
            Route::get('/get_user/{id}', 'TreeController@getUser')->name('get_user');
            Route::get('/update_position', 'TreeController@updatePosition')->name('updatePosition');
            Route::get('/destroy', 'TreeController@destroy')->name('destroy');
        });
    });
    Route::group(['namespace' => 'Departments', 'as' => 'departments.', 'prefix' => 'departments'], function ()
    {
        Route::get('/index', 'DepartmentController@index')->name('index');
        Route::post('/get_table_data', 'DepartmentController@getTableData')->name('get_table_data');

        Route::get('/create', 'DepartmentController@create')->name('create');
        Route::post('/store', 'DepartmentController@store')->name('store');
        Route::get('/edit/{id}', 'DepartmentController@edit')->name('edit');
        Route::post('/update', 'DepartmentController@update')->name('update');
        Route::get('/destroy/{id}', 'DepartmentController@destroy')->name('destroy');
    });
});
Route::group(['namespace' => 'Users', 'as' => 'users.', 'prefix' => 'users'], function ()
{
    Route::group(['as' => 'show.', 'prefix' => 'show'], function ()
    {
        Route::get('/index', 'ShowController@index')->name('index');
        Route::post('get_table_data', 'ShowController@getTableData')->name('get_table_data');
    });
});
