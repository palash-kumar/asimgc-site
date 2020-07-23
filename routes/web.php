<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
/* Routes for Site; Does not require login */
Route::get('/', 'PagesController@index');

Route::get('/commitments', 'PagesController@commitments')->name('commitment');

Route::get('/gallery', 'PagesController@gallery')->name('gallery');

Route::get('/projects', 'PagesController@projects')->name('projects');

Route::get('/app/dev', 'PagesController@developmentTest')->name('dev');


Auth::routes();

Route::get('app/home', 'HomeController@index')->name('home');
/* Controllers at Application End; Requires Login */
Route::resource('app/users','UsersController');
Route::post('app/users/updateStatus/{id}','UsersController@updateStatus');
Route::put('app/users/updateUserInfo/{id}','UsersController@updateUserInfo');
Route::put('app/users/updateUserDesignation/{id}','UsersController@updateUserDesignation');
Route::put('app/users/updateUserRole/{id}','UsersController@updateUserRole');

Route::resource('app/services','ServicesController');

Route::resource('app/designations','DesignationsController');
Route::post('app/designations/updateStatus/{id}','DesignationsController@updateStatus');
Route::put('app/designations/updateDisplaySeq/{id}','DesignationsController@updateDisplaySeq');

Route::resource('app/settings','SiteSettingsController');
Route::post('app/settings/updateStatus/{id}','SiteSettingsController@updateStatus');

Route::resource('app/gallery','GallerySettingsController');
Route::put('app/gallery/updateCategory/{id}','GallerySettingsController@updateImageCategory');

Route::resource('app/clients','ClientsController');
Route::post('app/clients/updateStatus/{id}','ClientsController@updateStatus');

Route::resource('app/projects','ProjectsController');
Route::post('app/projects/updateStatus/{id}','ProjectsController@updateStatus');
Route::post('app/projects/updateProjectStatus/{id}','ProjectsController@updateProjectStatus');