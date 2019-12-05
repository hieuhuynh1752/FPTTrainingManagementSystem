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
    return view('welcome');
});


//Route::post('admin/update','AdminController@update')->name('admin.update');
//Route::get('admin/destroy/{id}','AdminController@destroy');



Route::group(['middleware'=>['isadmin']], function(){
    //Route::resource('users','AdminController');

    Route::get('admin','AdminController@index')->name('admin.index');
    Route::get('admin/{id}/edit','AdminController@edit')->name('admin.edit');
    Route::get('admin/{id}/delete','AdminController@destroy')->name('admin.destroy');
    Route::get('admin/create','AdminController@create')->name('admin.create');
    Route::post('admin/create','AdminController@store')->name('admin.store');
    Route::get('admin/update','AdminController@update')->name('admin.update');
    Route::post('admin/update','AdminController@update')->name('admin.update');
    Route::get('search', 'AdminController@search');
});

//Route::get('admin/acclist', 'AdminController@index');
//Route::get('admin/acclist/{id}/edit','AdminController@edit');
//Route::post('admin/acclist/store','AdminController@store');
//Route::get('admin/acclist/delete/{id}','AdminController@destroy');

Route::get('trainingstaff', ['middleware'=>'istrainingstaff',function () {
    return view('trainingstaff.index');
}]);
Route::get('trainer', ['middleware'=>'istrainer',function () {
    return view('trainer.index');
}]);
Route::get('trainee', ['middleware'=>'istrainee',function () {
    return view('trainee.index');
}]);

Auth::routes();

//Route::get('/login',function(){
 //   return view('auth.login');
//});
Route::get('/home', 'HomeController@index')->name('home');
