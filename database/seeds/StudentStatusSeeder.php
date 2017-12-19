<?php

use Illuminate\Database\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\StudentStatus::insert([
            ['name' => 'Transfer'],
            ['name' => 'Undergraduate'],
            ['name' => 'Graduate'],
            ['name' => 'other']
        ]);

    }
}
