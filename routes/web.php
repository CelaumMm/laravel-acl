<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){    
    $this->get('/', 'AdminController@index')->name('admin.home');
});

$this->post('atualizar-perfil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
$this->get('meu-perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');

$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
