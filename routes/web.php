<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
});

Route::resource('posts', 'PostController');

// Site
Route::get('meu-perfil', 'ProfileController@profile')->name('profile')->middleware('auth');
Route::post('atualizar-perfil', 'ProfileController@update')->name('profile.update')->middleware('auth');

Route::get('/', 'PostController@index')->name('home');

Auth::routes();
