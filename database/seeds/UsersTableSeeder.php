<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('s12345'),
            'role' => 1,
            'status' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Non Member',
            'username' => 'nonmember',
            'password' => bcrypt('s12345'),
            'role' => 3,
            'status' => 1
        ]);

        DB::table('member')->insert([
            'user_id' => 2,
            'tanggal_lahir' => '2000-01-01',
            'tipe' => 1,
            'saldo' => 0
        ]);
    }
}
