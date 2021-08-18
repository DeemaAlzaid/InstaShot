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
});

Route::post('signin', 'UserController@postSignIn')->name('postSignIn');


Route::get('logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'logout',
]);


Route::get('post', function () {
    return view('post');
});


Route::get('timeline', [
    'uses' => 'PostController@getTimeline',
    'as' => 'timeline',
])->middleware('auth');


Route::post('createpost', 'PostController@postCreatePost')->name('post.create');


Route::get('/delete-post/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete',
])->middleware('auth');


Route::post('/edit', function (\Illuminate\Http\Request $request) {
    return response()->json(['message' => $request['postId']]);
    
})->name('edit');


Route::post('/comment/{post_id}', [
    'uses' => 'PostController@addComment',
    'as' => 'post.comment',
])->middleware('auth');
