<?php


Auth::routes();

Route::post('atualizar-perfil', 'ProfileController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('meu-perfil', 'ProfileController@profile')->name('profile')->middleware('auth');

Route::get('/', 'PostController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('posts', 'PostController');
