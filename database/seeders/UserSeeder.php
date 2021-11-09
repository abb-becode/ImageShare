<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          [
            'username' => 'abb',
            'name' => 'abdelilah',
            'email' => 'abb@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
          ],
          [
            'username' => 'kea',
            'name' => 'kevin',
            'email' => 'keab@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
          ]
        ]);
    }
}
