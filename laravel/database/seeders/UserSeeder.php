<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate(['email' => env('EMAIL_VISITOR')], [
            'name'     => 'Návštěvník',
            'password' => Hash::make(env('PASSWORD_VISITOR')),
        ]);

        \App\User::firstOrCreate(['email' => env('EMAIL_ADMIN')], [
            'name'     => 'Admin',
            'password' => Hash::make(env('PASSWORD_ADMIN')),
        ]);
    }
}
