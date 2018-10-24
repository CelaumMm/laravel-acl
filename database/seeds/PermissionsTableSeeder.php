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
        Permission::create([
            'name'          => 'Administer roles & permissions',
            'guard_name'    => 'web',
        ]);

        Permission::create([
            'name'          => 'Create Post',
            'guard_name'    => 'web',
        ]);

        Permission::create([
            'name'          => 'Edit Post',
            'guard_name'    => 'web',
        ]);

        Permission::create([
            'name'          => 'Delete Post',
            'guard_name'    => 'web',
        ]);
    }
}
