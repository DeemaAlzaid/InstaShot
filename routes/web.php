<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('signup', function () {
    return view('signup');
})->name('signup');

Route::post('signup', 'UserController@postSignUp')->name('postSignUp');

Route::get('signin', function () {
    return view('signin');
})->name('signin');

Route::post('signin', 'UserController@postSignIn')->name('postSignIn');

Route::get('logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'logout',
]);

Route::get('post', function () {
    return view('post');
})->name('post');

Route::get('timeline', 'PostController@create')->name('timeline');

Route::post('post-create', 'PostController@store')->name('post.create');

Route::get('/delete-post/{id}', [
    'uses' => 'PostController@destroy',
    'as' => 'post.delete',
])->middleware('auth');

Route::get('/edit-post/{id}', [
    'uses' => 'PostController@edit',
    'as' => 'post.edit',
])->middleware('auth');

Route::post('/update-post/{id}', [
    'uses' => 'PostController@update',
    'as' => 'post.update',
])->middleware('auth');

//Route::get('post/{id}', function () {
//    return view('postPage');
//})->name('postPage');

Route::get('/post/{post}', [
    'uses' => 'CommentsController@show',
    'as' => 'comments.show',
])->middleware('auth');

Route::post('/post/{id}', [
    'uses' => 'CommentsController@store',
    'as' => 'comments.store',
])->middleware('auth');
