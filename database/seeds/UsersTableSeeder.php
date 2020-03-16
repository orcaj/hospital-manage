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
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'type' => 'super',
            'password' => bcrypt('admin'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'user',
            'email' => 'user@user.com',
            'type' => 'staff',
            'password' => bcrypt('user'),
        ]);
    }
}
