<?php

use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'id' => 1,
            'name' => 'john',
            'civil_id' => 'jo-2020-364',
            'phone' => '15689-368-42',
            'email' => 'john@j.com',
            'address' => 'Hospital keras',
        ]);
    }
}
