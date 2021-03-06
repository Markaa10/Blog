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

Route::get('/', [
    'uses' => 'FrontEndController@index',
    'as' => 'index'
]);

Route::get('/results', function() {
    $posts = \App\Post::where('title', 'like', '%' . request('query') . '%')->get();

    return view('results')->with('posts', $posts)
                        ->with('title', 'Search results: ' . request('query'))
                        ->with('categories', \App\Category::take(5)->get())
                        ->with('settings', \App\Setting::first())
                        ->with('query', request('query'));
});

Route::get('/post/{slug}', [
    'uses' => 'FrontEndController@singlePost',
    'as' => 'post.single'
]);

Route::get('/category/{id}', [
    'uses' => 'FrontEndController@category',
    'as' => 'category.single'
]);

Route::get('/tag/{id}', [
    'uses' => 'FrontEndController@tag',
    'as' => 'tag.single'
]);

Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {


	Route::get('dashbaord', 'HomeController@index')->name('home');
    
    Route::get('/post/create', [
        'uses' => 'PostsController@create',
        'as' => 'post.create'
    ]);

    Route::post('/post/store', [
        'uses' => 'PostsController@store',
        'as' => 'post.store'
    ]);

    Route::get('posts', [
    	'uses' => 'PostsController@index',
    	'as' => 'posts'
    ]);

    Route::get('post/edit/{id}', [
        'uses' => 'PostsController@edit',
        'as' => 'post.edit'
    ]);

    Route::post('post/update/{id}', [
        'uses' => 'PostsController@update',
        'as' => 'post.update'
    ]);

    Route::get('post/restore/{id}', [
    	'uses' => 'PostsController@restore',
    	'as' => 'post.restore'
    ]);

    Route::get('post/delete/{id}', [
    	'uses' => 'PostsController@delete',
    	'as' => 'post.delete'
    ]);

    Route::get('post/trashed', [
    	'uses' => 'PostsController@trashed',
    	'as' => 'post.trashed'
    ]);

    Route::get('post/destroy/{id}', [
    	'uses' => 'PostsController@destroy',
    	'as' => 'post.destroy'
    ]);






    Route::get('/categories', [
    	'uses' => 'CategoriesController@index',
    	'as' => 'categories'
    ]);

    Route::get('/category/create', [
    	'uses' => 'CategoriesController@create',
    	'as' => 'category.create'
    ]);

    Route::post('/category/store', [
    	'uses' => 'CategoriesController@store',
    	'as' => 'category.store'
    ]);

    Route::get('/category/edit/{id}', [
    	'uses' => 'CategoriesController@edit',
    	'as' => 'category.edit'
    ]);

    Route::post('/category/update/{id}', [
    	'uses' => 'CategoriesController@update',
    	'as' => 'category.update'
    ]);

    Route::get('/category/delete/{id}', [
    	'uses' => 'CategoriesController@destroy',
    	'as' => 'category.destroy'
    ]); 







    Route::get('/tags', [
        'uses' => 'TagsController@index',
        'as' => 'tags'
    ]);

    Route::get('/tag/create', [
        'uses' => 'TagsController@create',
        'as' => 'tag.create'
    ]);

    Route::post('/tag/store', [
        'uses' => 'TagsController@store',
        'as' => 'tag.store'
    ]);

    Route::get('/tag/edit/{id}', [
        'uses' => 'TagsController@edit',
        'as' => 'tag.edit'
    ]);

    Route::post('/tag/update/{id}', [
        'uses' => 'TagsController@update',
        'as' => 'tag.update'
    ]);

    Route::get('/tag/delete/{id}', [
        'uses' => 'TagsController@destroy',
        'as' => 'tag.destroy'
    ]); 




    Route::get('/users', [
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);

    Route::get('/users/create', [
        'uses' => 'UsersController@create',
        'as' => 'user.create'
    ]);

    Route::post('/users/store', [
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ]);

    Route::get('/users/admin/{id}', [
        'uses' => 'UsersController@admin',
        'as' => 'user.admin'
    ]);

    Route::get('/users/not-admin/{id}', [
        'uses' => 'UsersController@not_admin',
        'as' => 'user.not.admin'
    ]);

    Route::get('/users/delete()/{id}', [
        'uses' => 'UsersController@destroy',
        'as' => 'user.destroy'
    ]);






    Route::get('/users/profile', [
        'uses' => 'ProfilesController@index',
        'as' => 'user.profile'
    ]);

    Route::post('/users/profile/update', [
        'uses' => 'ProfilesController@update',
        'as' => 'user.profile.update'
    ]);




    Route::get('settings', [
        'uses' => 'SettingsController@index',
        'as' => 'settings'
    ]);

    Route::post('settings/update', [
        'uses' => 'SettingsController@update',
        'as' => 'settings.update'
    ]);

});