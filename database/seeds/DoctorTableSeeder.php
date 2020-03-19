<?php

use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            'id' => 1,
            'name' => 'marry',
            'email' => 'marry@doc.com',
            'department_id' => 1,
            'tel' => '123456',
        ]);
    }
}
