<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'KridaControl@home');
Route::post('/admin/login', 'KridaControl@login');
Route::post('/admin/upload_slide', 'KridaControl@uploadSlide');
Route::post('/admin/delete_slide', 'KridaControl@deleteSlide');
Route::post('/admin/upload_testimoni', 'KridaControl@uploadTestimoni');
Route::post('/admin/delete_testimoni', 'KridaControl@deleteTestimoni');
Route::post('/admin/update_people/{id}', 'KridaControl@updatePeople');
Route::post('/admin/update_achievement/{id}', 'KridaControl@updateAchievement');
Route::post('/admin/update_testimoni/{id}', 'KridaControl@updateTestimoni');
Route::post('/admin/update_news/{id}', 'KridaControl@updateNews');
Route::post('/admin/update_event/{id}', 'KridaControl@updateEvent');
Route::post('/admin/update_gallery/{id}', 'KridaControl@updateGallery');
Route::post('/admin/update_image/{id}', 'KridaControl@updateImage');
Route::post('/admin/update_about', 'KridaControl@updateAbout');
Route::post('/admin/delete_people', 'KridaControl@deletePeople');
Route::post('/admin/upload_people', 'KridaControl@uploadPeople');
Route::post('/admin/upload_achievement', 'KridaControl@uploadAchievement');
Route::post('/admin/delete_achievement', 'KridaControl@deleteAchievement');
Route::post('/admin/delete_news', 'KridaControl@deleteNews');
Route::post('/admin/delete_event', 'KridaControl@deleteEvent');
Route::post('/admin/delete_gallery', 'KridaControl@deleteGallery');
Route::post('/admin/update_password', 'KridaControl@updatePassword');
Route::post('/upload_comment', 'KridaControl@uploadComment');
Route::post('/admin/delete_comment', 'KridaControl@deleteComment');
Route::post('/admin/upload_news', 'KridaControl@uploadNews');
Route::post('/admin/upload_event', 'KridaControl@uploadEvent');
Route::post('/admin/upload_gallery', 'KridaControl@uploadGallery');
Route::post('/admin/upload_image/{tipe}/{id}', 'KridaControl@uploadImage');
Route::post('admin/{page}/delete_image/{id}', 'KridaControl@deleteImage');
Route::post('{lang}/search', 'KridaControl@search');
Route::post('m/{lang}/search', 'KridaControl@search');
Route::get('/admin/newsmanager/edit/{id}', 'KridaControl@editNews');
Route::get('admin/image/edit/{id}', 'KridaControl@editImage');
Route::get('admin/about', 'KridaControl@editAbout');
Route::get('/admin/eventmanager/edit/{id}', 'KridaControl@editEvent');
Route::get('/admin/galleries/edit/{id}', 'KridaControl@editGallery');
Route::get('admin/setprimaryimage/{tipe}/{tipeid}/{imageid}', 'KridaControl@setPrimaryImage');
Route::get('admin/read/{id}', 'KridaControl@readMessage');
Route::get('/admin/login', 'KridaControl@loginpage');
Route::get('/admin/logout', 'KridaControl@logout');
Route::get('/admin/peoples/edit/{id}', 'KridaControl@editPeople');
Route::get('/admin/achievements/edit/{id}', 'KridaControl@editAchievement');
Route::get('/admin/testimonial/edit/{id}', 'KridaControl@editTestimoni');
Route::get('/admin/dashboard/viewform/{id}', 'KridaControl@viewRecruitment');
Route::get('/admin/dashboard/form/{status}/{id}', 'KridaControl@setStatusRecruitment');
Route::get('/recruitment', 'KridaControl@rekrutmentRedirect');
Route::post('/recruitment/{id}', 'KridaControl@updateRecruitment');

Route::get('/admin', function() {
  return redirect()->action('KridaControl@getAdmin',['dashboard']);
});
Route::get('/admin/{curpage}', 'KridaControl@getAdmin');

// Modified By Muhammad Muhlas
// Change from mobile page method to non mobile page method

// Route::get('/m/{lang}/{curpage}', 'KridaControl@getMobilePage');
Route::get('/m/{lang}/{curpage}', 'KridaControl@getPage');
Route::get('/{lang}/{curpage}', 'KridaControl@getPage');
Route::get('{lang}/gallery/{orig}', 'KridaControl@buildGallery');
Route::get('{lang}/galleries/{orig}', 'KridaControl@buildGallery');

Route::get('{lang}/news/{id}', 'KridaControl@newsPost');
Route::get('{lang}/events/{id}', 'KridaControl@eventsPost');

// Modified By Muhammad Muhlas
// Change from mobile page method to non mobile page method
Route::get('m/{lang}/news/{id}', 'KridaControl@newsPostm');
Route::get('m/{lang}/events/{id}', 'KridaControl@eventsPostm');

Route::get('/.env', 'KridaControl@disableAccess');



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});