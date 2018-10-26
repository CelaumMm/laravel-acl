<?php

use Illuminate\Database\Seeder;

//Importing laravel-permission models
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'manage users', 'guard_name' => 'web',]);
        Permission::create([ 'name' => 'manage roles', 'guard_name' => 'web']);
        Permission::create([ 'name' => 'manage permissions', 'guard_name' => 'web']);
        Permission::create([ 'name' => 'create post', 'guard_name' => 'web']);
        Permission::create([ 'name' => 'edit post', 'guard_name' => 'web']);
        Permission::create([ 'name' => 'delete post', 'guard_name' => 'web']);
        Permission::create([ 'name' => 'publish post', 'guard_name' => 'web']);
    }
}
