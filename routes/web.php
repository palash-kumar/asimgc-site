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

Route::get('/dev', 'PagesController@developmentTest')->name('dev');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/* Controllers at Application End; Requires Login */
Route::resource('services','ServicesController');

Route::resource('settings','SiteSettingsController');
Route::post('settings/updateStatus/{id}','SiteSettingsController@updateStatus');

Route::resource('gallery','GallerySettingsController');
Route::put('gallery/updateCategory/{id}','GallerySettingsController@updateImageCategory');

Route::resource('clients','ClientsController');
Route::post('clients/updateStatus/{id}','ClientsController@updateStatus');

Route::resource('projects','ProjectsController');
Route::post('projects/updateStatus/{id}','ProjectsController@updateStatus');
Route::post('projects/updateProjectStatus/{id}','ProjectsController@updateProjectStatus');