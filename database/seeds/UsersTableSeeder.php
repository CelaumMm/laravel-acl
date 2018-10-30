<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Administrador master',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('123456'),
        ])->assignRole('super-admin');

        User::create([
            'name'      => 'Editor',
            'email'     => 'user@user.com',
            'password'  => Hash::make('123456'),
        ])->assignRole('editor');
    }
}
