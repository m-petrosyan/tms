<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['email' => 'john@gmail.com'], [
            'full_name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => '12345678',
        ]);

        User::factory(5)->create();
    }
}
