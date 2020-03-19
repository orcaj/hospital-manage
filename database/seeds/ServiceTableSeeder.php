<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'id' => 1,
            'name' => 'service_health',
            'price' => 120,
            'department_id' => 1,
            'doctor_id' => 1,
        ]);
    }
}
