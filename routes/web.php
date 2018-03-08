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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin', 'forbid-banned-user']], function() {
    Route::get('/', 'DashboardController@index')->name('admin');

    Route::get('/categories/toggle/{slug}', 'CategoriesController@toggle')->name('categories.toggle');
    Route::resource('/categories', 'CategoriesController', ['except' => ['show']]);

    Route::get('/tags/toggle/{slug}', 'TagsController@toggle')->name('tags.toggle');
    Route::resource('/tags', 'TagsController', ['except' => ['show']]);

    Route::get('/users/toggle/{id}', 'UsersController@toggle')->name('users.toggle');
    Route::get('/users/toggleRole/{id}', 'UsersController@toggleRole')->name('users.toggleRole');
    Route::resource('/users', 'UsersController', ['except' => ['show']]);

    Route::get('/posts/toggle/{slug}', 'PostsController@toggle')->name('posts.toggle');
    Route::get('/posts/toggleFeatured/{slug}', 'PostsController@toggleFeatured')->name('posts.toggleFeatured');
    Route::resource('/posts', 'PostsController', ['except' => ['show']]);

    Route::get('/comments', 'CommentsController@index');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggleStatus');
    Route::delete('/comments/{id}', 'CommentsController@destroy')->name('comments.destroy');

    Route::get('/pages/toggle/{slug}', 'PagesController@toggle')->name('pages.toggle');
    Route::resource('/pages', 'PagesController');
});

Route::paginate('/', 'HomeController@index')->name('home');
Route::paginate('/tags/{slug}', 'HomeController@tag')->name('tag.show');
Route::paginate('/categories/{slug}', 'HomeController@category')->name('category.show');
Route::get('/user/{id}', 'UserController@index')->name('user');
Route::get('/{categorySlug}/{postSlug}', 'HomeController@show')->name('post.show');
Route::paginate('/search', 'SearchController@index')->name('search');
Route::post('/mail', 'MailController@index')->name('mail');
Route::paginate('/archives/{year}/{month}', 'ArchivesController@index')->name('archives');

Route::group(['middleware' => ['auth', 'forbid-banned-user']], function() {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/comment', 'CommentsController@store')->name('comment');
});

Auth::routes();

Route::get('/{page}', 'PagesController@index')->name('pages');
