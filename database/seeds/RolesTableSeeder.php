<?php

use Illuminate\Database\Seeder;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'super-admin',
            'guard_name'    => 'web',
        ]);

        Role::create([
            'name'          => 'editor',
            'guard_name'    => 'web',
        ])->givePermissionTo(['create post', 'edit post']);
    }
}
