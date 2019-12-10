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
    //buttons
    Route::get('course/{id}/edit','CourseController@edit')->name('course.edit');
    Route::get('course/{id}/delete','CourseController@destroy')->name('course.destroy');
    Route::get('course/{id}/detail','CourseController@detail')->name('course.detail');
    Route::get('course/{id}/assign','CourseController@assign')->name('course.assign');

    Route::get('course/create','CourseController@create')->name('course.create');
    Route::post('course/create','CourseController@store')->name('course.store');
    Route::get('course/update','CourseController@update')->name('course.update');
    Route::post('course/update','CourseController@update')->name('course.update');

    Route::get('course/topic','CourseController@topic')->name('course.topic');
    Route::post('course/topic','CourseController@topic')->name('course.topic');
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
    Route::get('trainers','TrainerController@index')->name('trainers.index');
    Route::get('trainers/{id}/edit','TrainerController@edit')->name('trainers.edit');
    Route::get('trainers/{id}/delete','TrainerController@destroy')->name('trainers.destroy');
    Route::get('trainers/create','TrainerController@create')->name('trainers.create');
    Route::post('trainers/create','TrainerController@store')->name('trainers.store');
    Route::get('trainers/update','TrainerController@update')->name('trainers.update');
    Route::post('trainers/update','TrainerController@update')->name('trainers.update');
    Route::get('search', 'TrainerController@search');


    //trainee-routing
    Route::get('trainees','TraineeController@index')->name('trainees.index');
    Route::get('trainees/{id}/edit','TraineeController@edit')->name('trainees.edit');
    Route::get('trainees/{id}/delete','TraineeController@destroy')->name('trainees.destroy');
    Route::get('trainees/{id}/assign','TraineeController@assign')->name('trainees.assign');

    Route::get('trainees/create','TraineeController@create')->name('trainees.create');
    Route::post('trainees/create','TraineeController@store')->name('trainees.store');
    Route::get('trainees/update','TraineeController@update')->name('trainees.update');
    Route::post('trainees/update','TraineeController@update')->name('trainees.update');

    Route::get('trainees/course','TraineeController@course')->name('trainees.course');
    Route::post('trainees/course','TraineeController@course')->name('trainees.course');
    Route::get('search', 'TraineeController@search');

    });

//Route::get('admin/acclist', 'AdminController@index');
//Route::get('admin/acclist/{id}/edit','AdminController@edit');
//Route::post('admin/acclist/store','AdminController@store');
//Route::get('admin/acclist/delete/{id}','AdminController@destroy');

Route::group(['middleware'=>['istrainer']], function(){
    //Route::resource('users','AdminController');

    Route::get('trainer','UserController@index')->name('trainer.index');
    Route::get('trainer/{id}/detail','UserController@detail')->name('trainer.detail');
    Route::get('trainer/edit','UserController@edit')->name('trainer.edit');
    //Route::get('admin/{id}/delete','AdminController@destroy')->name('admin.destroy');
    //Route::get('admin/create','AdminController@create')->name('admin.create');
    //Route::post('admin/create','AdminController@store')->name('admin.store');
    Route::get('trainer/update','UserController@update')->name('trainer.update');
    Route::post('trainer/update','UserController@update')->name('trainer.update');
    //Route::get('search', 'AdminController@search');
});

Route::group(['middleware'=>['istrainee']], function(){
    //Route::resource('users','AdminController');

    Route::get('trainee','UserController@index')->name('trainee.index');
    Route::get('trainee/{id}/detail','UserController@detail')->name('course.detail');
    //Route::get('trainer/edit','UserController@edit')->name('trainer.edit');
    //Route::get('admin/{id}/delete','AdminController@destroy')->name('admin.destroy');
    //Route::get('admin/create','AdminController@create')->name('admin.create');
    //Route::post('admin/create','AdminController@store')->name('admin.store');
    //Route::get('trainer/update','UserController@update')->name('trainer.update');
    //Route::post('trainer/update','UserController@update')->name('trainer.update');
    //Route::get('search', 'AdminController@search');
});

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
