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


Route::get('/', 'StudentController@attendance');

Route::prefix('faculty')->group(function(){
  Route::get('/login','Auth\FacultyLoginController@showLoginForm')->name('faculty.login');
  Route::post('/login','Auth\FacultyLoginController@login')->name('faculty.login.submit');
  Route::get('/', 'TeacherController@login')->name('admin.dashboard');


});




Route::get('/basic', 'HomeController@basic');
Route::get('/settings', 'GenericController@setting');



Route::post('/changeSettings', 'GenericController@changeSettings');


// Student Routes

Route::get('/attendance', 'StudentController@attendance');
Route::get('/academic', 'StudentController@academic');
Route::get('/academic/{id}', 'StudentController@academic_details');

Route::get('/announcement', 'StudentController@announcement');
Route::get('/give_feedback', 'StudentController@feedback');
Route::post('/submit_feedback', 'StudentController@submit_feedback');


// End - Student Routes


// Teacher Routes
Route::get('/add_attendance', 'TeacherController@add_attendance')->name('addAttendance')->middleware('auth:faculty');
Route::get('/edit_attendance', 'TeacherController@edit_attendance')->middleware('auth:faculty');
Route::get('/edit_attendance/{id}', 'TeacherController@edit_attendance_view');
Route::post('/update_attendance', 'TeacherController@update_attendance');



Route::get('/add_evaluation', 'TeacherController@add_evaluation');
Route::get('/edit_evaluation', 'TeacherController@edit_evaluation');
Route::get('/edit_evaluation/{id}', 'TeacherController@edit_evaluation_view');
Route::post('/update_evaluation', 'TeacherController@update_evaluation');



Route::get('/make_announcement', 'TeacherController@make_announcement');
Route::get('/edit_announcement', 'TeacherController@edit_announcement')->name('editAnnouncement');
Route::get('/edit_announcement/{id}', 'TeacherController@edit_announcement_view');
Route::post('/update_announcement', 'TeacherController@update_announcement');
Route::get('/delete_announcement/{id}', 'TeacherController@delete_announcement');







Route::post('/get_students', 'TeacherController@get_students');
Route::post('/get_attendances', 'TeacherController@get_attendances');
Route::post('/get_evaluations', 'TeacherController@get_evaluations');


Route::post('/submit_attendance', 'TeacherController@submit_attendance');
Route::post('/submit_evaluation', 'TeacherController@submit_evaluation');

Route::post('/submit_announcement', 'TeacherController@submit_announcement');


Route::post('/update_feedbackCount', 'TeacherController@update_feedbackCount');
Route::post('/update_notificationCount', 'GenericController@update_notificationCount');







// To Do -- Teacher
Route::get('/feedback', 'TeacherController@feedback');
// End - Teacher Routes


// Admin Routes

Route::get('/manage_calender', 'AdminController@manage_calender');


Route::get('/add_class', 'AdminController@add_class')->name('addClass');
Route::post('/add_class', 'AdminController@submit_class');

Route::get('/manage_class', 'AdminController@manage_class');
Route::get('/manage_class/edit/{id}', 'AdminController@manage_class_edit');
Route::get('/manage_class/delete/{id}', 'AdminController@manage_class_delete');
Route::post('/edit_class', 'AdminController@edit_class');





Route::get('/add_section', 'AdminController@add_section');
Route::post('/add_section', 'AdminController@submit_section');
Route::get('/manage_section', 'AdminController@manage_section');
Route::get('/manage_section/edit/{id}', 'AdminController@manage_section_edit');
Route::get('/manage_section/delete/{id}', 'AdminController@manage_section_delete');
Route::post('/edit_section', 'AdminController@edit_section');

Route::post('/get_sections', 'AdminController@get_sections');




Route::get('/add_teacher', 'AdminController@add_teacher');
Route::post('/add_teacher', 'AdminController@submit_teacher');
Route::get('/manage_teacher', 'AdminController@manage_teacher');
Route::get('/manage_teacher/edit/{id}', 'AdminController@manage_teacher_edit');
Route::get('/manage_teacher/delete/{id}', 'AdminController@manage_teacher_delete');
Route::post('/edit_teacher', 'AdminController@edit_teacher');




Route::get('/add_student', 'AdminController@add_student');
Route::post('/add_student', 'AdminController@submit_student');
Route::get('/manage_student', 'AdminController@manage_student');
Route::get('/manage_student/edit/{id}', 'AdminController@manage_student_edit');
Route::get('/manage_student/delete/{id}', 'AdminController@manage_student_delete');
Route::post('/edit_student', 'AdminController@edit_student');





Route::get('/add_subject', 'AdminController@add_subject');
Route::post('/add_subject', 'AdminController@submit_subject');
Route::get('/manage_subject', 'AdminController@manage_subject');
Route::get('/manage_subject/edit/{id}', 'AdminController@manage_subject_edit');
Route::get('/manage_subject/delete/{id}', 'AdminController@manage_subject_delete');
Route::post('/edit_subject', 'AdminController@edit_subject');


Route::post('/upload_image', 'GenericController@upload_image');





Route::get('/assign_teacher', 'AdminController@assign_teacher_view');
Route::post('/assign_teacher', 'AdminController@assign_teacher')->name('AssignTeacher');

Route::get('/assign_subject', 'AdminController@assign_subject_view');
Route::post('/assign_subject', 'AdminController@assign_subject');

Route::get('/assign_subject/remove/{id}/{classId}', 'AdminController@assign_subject_remove');
Route::get('/assign_teacher/remove/{subjectId}/{facultyId}/{sectionId}', 'AdminController@assign_teacher_remove');








// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





// Practice Vue.js
Route::get('/vue', 'TeacherController@vue')->middleware('auth:faculty');





// Faculty Admin Routes
