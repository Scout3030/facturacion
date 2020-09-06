<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Storage::deleteDirectory('users');
        // Storage::deleteDirectory('banks');

        // Storage::makeDirectory('users');
        // Storage::makeDirectory('banks');

        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'user']);

        factory(\App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::ADMIN,
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::USER,
        ]);

        factory(\App\Client::class, 10)->create();
    }
}
