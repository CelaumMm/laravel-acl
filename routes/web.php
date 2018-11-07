<?php


Auth::routes();

Route::post('atualizar-perfil', 'ProfileController@update')->name('profile.update')->middleware('auth');
Route::get('meu-perfil', 'ProfileController@profile')->name('profile')->middleware('auth');

Route::get('/', 'PostController@index')->name('home');

Route::resource('users', 'Admin\UserController');
Route::resource('roles', 'Admin\RoleController');
Route::resource('permissions', 'Admin\PermissionController');
Route::resource('posts', 'PostController');
