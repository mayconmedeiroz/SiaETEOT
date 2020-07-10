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

Route::get("/index", function() {
    return view('index');
});

//Routes referencess auth
Route::middleware(["guest"])->get("/login", "Auth\LoginController@showLoginForm")->name("login");

Route::middleware(["guest"])->post("/login", "Auth\LoginController@login");

Route::post("/logout", "Auth\LoginController@logout")->name("logout");

Route::middleware(["auth"])->get("/password/confirm", "Auth\ConfirmPasswordController@showConfirmForm")->name("password.confirm");

Route::middleware(["auth"])->post("/password/confirm", "Auth\ConfirmPasswordController@confirm");

Route::post("/password/email", "Auth\ForgotPasswordController@sendResetLinkEmail")->name("password.email");

Route::post("/password/reset", "Auth\ResetPasswordController@reset")->name("password.update");

Route::get("/password/reset", "Auth\ForgotPasswordController@showLinkRequestForm")->name("password.request");

Route::get("/password/reset/{token}", "Auth\ResetPasswordController@showResetForm")->name("password.reset");


Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(["auth"])->prefix("dashboard")->group(function () {

    Route::middleware(["employee"])->group(function () {

        Route::resource("/student", "Student\StudentController");

        Route::resource("/responsible", "Student\ResponsibleController");
    

        Route::resource('/studentunit', 'StudentUnit\StudentUnitController');
        
        Route::resource('/transfersu', 'StudentUnit\TransferSusController');
        
        Route::resource('/course', 'Course\CourseController');

        Route::resource('/schoolclass', 'Course\SchoolClassController');
    
        Route::resource("/discipline", "Course\DisciplineController");
   
        Route::resource("/disciplineschoolclass", "Course\DisciplineSchoolClassController");
        
    });

});

Route::resource('/employee', 'Employee\EmployeeController');      

Route::resource('/occupation', 'Employee\OccupationsController');

Route::resource('/coursediscipline', 'Course\CourseDisciplineController');

Route::resource('/position', 'Employee\PositionController');

Route::resource('/exerts', 'Employee\ExertsController');

Route::resource('/able', 'Employee\AbleController');