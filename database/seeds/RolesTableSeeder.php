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
            'name'          => 'Admin',
            'guard_name'    => 'web',
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1
            ]
        ]);
    }
}
