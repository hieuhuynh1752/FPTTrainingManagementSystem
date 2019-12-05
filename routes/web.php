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

Route::group(['middleware'=>['istrainingstaff']], function(){
    //Route::resource('users','AdminController');
    //main-index
    Route::get('trainingstaff','TrainingStaffController@index')->name('trainingstaff.index');

    //course-routing
    Route::get('course','CourseController@index')->name('course.index');
    Route::get('course/{id}/edit','CourseController@edit')->name('course.edit');
    Route::get('course/{id}/delete','CourseController@destroy')->name('course.destroy');
    Route::get('course/create','CourseController@create')->name('course.create');
    Route::post('course/create','CourseController@store')->name('course.store');
    Route::get('course/update','CourseController@update')->name('course.update');
    Route::post('course/update','CourseController@update')->name('course.update');
    Route::get('search', 'CourseController@search');


    //coursecategory-routing
    Route::get('coursecategory','CourseCategoryController@index')->name('coursecategory.index');
    Route::get('coursecategory/{id}/edit','CourseCategoryController@edit')->name('coursecategory.edit');
    Route::get('coursecategory/{id}/delete','CourseCategoryController@destroy')->name('coursecategory.destroy');
    Route::get('coursecategory/create','CourseCategoryController@create')->name('coursecategory.create');
    Route::post('coursecategory/create','CourseCategoryController@store')->name('coursecategory.store');
    Route::get('coursecategory/update','CourseController@update')->name('coursecategory.update');
    Route::post('coursecategory/update','CourseCategoryController@update')->name('coursecategory.update');
    Route::get('search', 'CourseCategoryController@search');


    //topic-routing
    Route::get('topic','TopicController@index')->name('topic.index');
    Route::get('topic/{id}/edit','TopicController@edit')->name('topic.edit');
    Route::get('topic/{id}/delete','TopicController@destroy')->name('topic.destroy');
    Route::get('topic/create','TopicController@create')->name('topic.create');
    Route::post('topic/create','TopicController@store')->name('topic.store');
    Route::get('topic/update','TopicController@update')->name('topic.update');
    Route::post('topic/update','TopicController@update')->name('topic.update');
    Route::get('search', 'TopicController@search');


    //trainer-routing
    Route::get('trainer','TrainerController@index')->name('trainer.index');
    Route::get('trainer/{id}/edit','TrainerController@edit')->name('trainer.edit');
    Route::get('trainer/{id}/delete','TrainerController@destroy')->name('trainer.destroy');
    Route::get('trainer/create','TrainerController@create')->name('trainer.create');
    Route::post('trainer/create','TrainerController@store')->name('trainer.store');
    Route::get('trainer/update','TrainerController@update')->name('trainer.update');
    Route::post('trainer/update','TrainerController@update')->name('trainer.update');
    Route::get('search', 'TrainerController@search');


    //trainee-routing
    Route::get('trainee','TraineeController@index')->name('trainee.index');
    Route::get('trainee/{id}/edit','TraineeController@edit')->name('trainee.edit');
    Route::get('trainee/{id}/delete','TraineeController@destroy')->name('trainee.destroy');
    Route::get('trainee/create','TraineeController@create')->name('trainee.create');
    Route::post('trainee/create','TraineeController@store')->name('trainee.store');
    Route::get('trainee/update','TraineeController@update')->name('trainee.update');
    Route::post('trainee/update','TraineeController@update')->name('trainee.update');
    Route::get('search', 'TraineeController@search');

    });

//Route::get('admin/acclist', 'AdminController@index');
//Route::get('admin/acclist/{id}/edit','AdminController@edit');
//Route::post('admin/acclist/store','AdminController@store');
//Route::get('admin/acclist/delete/{id}','AdminController@destroy');

//Route::get('trainingstaff', ['middleware'=>'istrainingstaff',function () {
//    return view('trainingstaff.index');
//}]);

//Route::get('trainer', ['middleware'=>'istrainer',function () {
//    return view('trainer.index');
//}]);
//Route::get('trainee', ['middleware'=>'istrainee',function () {
//    return view('trainee.index');
//}]);

Auth::routes();

//Route::get('/login',function(){
 //   return view('auth.login');
//});
Route::get('/home', 'HomeController@index')->name('home');
