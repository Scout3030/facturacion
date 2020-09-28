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
//         Storage::deleteDirectory('users');
        // Storage::deleteDirectory('banks');

        // Storage::makeDirectory('users');
        // Storage::makeDirectory('banks');
        Storage::makeDirectory('profile');

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

        factory(\App\Currency::class, 1)->create([
            'name' => 'soles',
            'code' => 'PEN',
            'sign' => 'S/'
        ]);
        factory(\App\Currency::class, 1)->create([
            'name' => 'dólares',
            'code' => 'USD',
            'sign' => '$'
        ]);
        factory(\App\Currency::class, 1)->create([
            'name' => 'euros',
            'code' => 'EUR',
            'sign' => '€'
        ]);

        factory(\App\Proof::class, 1)->create([
            'code' => 1,
            'name' => 'Factura',
            'status' => \App\Proof::ACTIVE
        ]);
        factory(\App\Proof::class, 1)->create([
            'code' => 3,
            'name' => 'Boleta',
            'status' => \App\Proof::ACTIVE
        ]);
        factory(\App\Proof::class, 1)->create([
            'code' => 7,
            'name' => 'Nota de crédito'
        ]);
        factory(\App\Proof::class, 1)->create([
            'code' => 8,
            'name' => 'Nota de débito'
        ]);

        factory(\App\Document::class, 1)->create([
            'name' => 'RUC'
        ]);
        factory(\App\Document::class, 1)->create([
            'name' => 'DNI'
        ]);
        factory(\App\Document::class, 1)->create([
            'name' => 'Pasaporte'
        ]);
        factory(\App\Document::class, 1)->create([
            'name' => 'Carné de extranjería'
        ]);
        factory(\App\Document::class, 1)->create([
            'name' => 'Cédula diplomática de identidad'
        ]);
        factory(\App\Document::class, 1)->create([
            'name' => 'Documento tributario'
        ]);

        factory(\App\Client::class, 10)->create();

        factory(\App\Category::class, 6)->create();

        factory(\App\Product::class, 50)->create();

        factory(\App\Profile::class, 1)->create([
            'name' => 'Ingrese nombre',
            'address' => 'Ingrese dirección',
            'phone_number' => '999-999999',
            'email' => 'mail@business.com',
            'description' => 'Ingrese descripción'
        ]);
    }
}
