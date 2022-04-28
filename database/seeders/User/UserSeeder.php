<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@evertec.com',
            'profile'  => 1,
            'password' => Hash::make('evertec2022*'),
        ]);

        User::create([
            'name'     => 'Usuario 1',
            'email'    => 'user_1@evertec.com',
            'profile'  => 2,
            'password' => Hash::make('evertec2022*'),
        ]);

        User::create([
            'name'     => 'Usuario 2',
            'email'    => 'user_2@evertec.com',
            'profile'  => 2,
            'password' => Hash::make('evertec2022*'),
        ]);

        User::create([
            'name'     => 'Usuario 3',
            'email'    => 'user_3@evertec.com',
            'profile'  => 2,
            'password' => Hash::make('evertec2022*'),
        ]);

        User::create([
            'name'     => 'Usuario 4',
            'email'    => 'user_4@evertec.com',
            'profile'  => 2,
            'password' => Hash::make('evertec2022*'),
        ]);
    }
}
