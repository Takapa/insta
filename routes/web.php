<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*use 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/category', [CategoryController::class, 'store']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::resource('/post',PostController::class); //create all things from index to delete.  index php artisan route list
    Route::resource('/comment',CommentController::class)->except('store');
    Route::resource('/profile',ProfileController::class);
    Route::resource('/like',LikeController::class);
    Route::resource('/followUser',FollowUserController::class);

    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');

    Route::group(["prefix" => "admin/", "as" => "admin."], function () {
        #users
        Route::get('/users',[UsersController::class,'index'])->name('index');
        Route::delete('/users/{id}/deactivate',[UsersController::class,'deactivate'])->name('deactivate');
        Route::post('/users/{id}/activate',[UsersController::class,'activate'])->name('activate');

        #posts
        Route::get('/posts',[PostsController::class,'index'])->name('posts.index');
        Route::delete('/posts/{id}/hid',[PostsController::class,'hid'])->name('hid');
        Route::post('/posts/{id}/show',[PostsController::class,'show'])->name('show');

        #categories
        Route::get('/categories',[CategoriesController::class,'index'])->name('categories.index');
    });
});