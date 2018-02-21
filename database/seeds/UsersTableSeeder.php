<?php

use Illuminate\Database\Seeder;
use App\Models\User;


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
            'role_id'   => 1,
            'email'     => 'admin@email.com',
            'password'  => Hash::make('pass'),
            'number'    => 100010,
            'firstname' => 'John',
            'lastname'  => 'Doe',
            'is_active' => 1,
            'api_token' => str_random(128)
        ]);

        User::create([
            'role_id'   => 3,
            'email'     => 'user@email.com',
            'password'  => Hash::make('pass'),
            'number'    => 100013,
            'firstname' => 'Jane',
            'lastname'  => 'Doe',
            'is_active' => 1,
            'api_token' => str_random(128)
        ]);
    }
}
