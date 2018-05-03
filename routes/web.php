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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/permissions', 'PermissionController');
Route::resource('/roles', 'RoleController');
Route::resource('/users', 'UserController');
Route::middleware(['auth', 'permission_by_method'])->group(function () {
    Route::resource('/menus', 'MenuController');
    Route::post('/menus/upsort', 'MenuController@updateSort')->name('menus.update.sort');
});

Route::resource('/lookups', 'LookupController');
Route::resource('/units', 'UnitController');
Route::resource('/cities', 'CityController');
Route::resource('/provinces', 'ProvinceController');
Route::resource('/subdistricts', 'SubDistrictController');
Route::resource('/urbanvillages', 'UrbanVillageController');
