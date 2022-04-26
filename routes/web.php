<?php

use App\Http\Controllers\StoriesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\Admin\adminStoriesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckAdmin;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [LoginController::class, 'showLoginForm']);


Route::middleware(['auth'])->group(function(){

    Route::resource('/stories', StoriesController::class);
    Route::get('/edit-profile', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');

});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/story/{activeStory:slug}', [DashboardController::class, 'show'])->name('dashboard.show');
 Route::get('/email', [DashboardController::class, 'email'])->name('dashboard.email');

Route::namespace('Admin')->name('admin.stories.')->prefix('admin')->middleware(['auth', CheckAdmin::class])->group(function(){

    Route::get('/deleted_stories', [adminStoriesController::class, 'index'])->name('index');
    Route::put('/stories/restore/{id}', [adminStoriesController::class, 'restore'])->name('restore');
    Route::delete('/stories/delete/{id}', [adminStoriesController::class, 'delete'])->name('delete');
    Route::get('/stories/stats', [adminStoriesController::class, 'stats'])->name('stats');


});

Route::get('/image', function(){
    $img_path = public_path('storage/ban.png');
    $writePath = public_path('storage/thumbnail.png');
    $image = Image::make($img_path)->resize(225, 100);
    $image->save($writePath);
    return $image->response('jpg');

});
