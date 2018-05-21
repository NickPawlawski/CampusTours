<?php

use Illuminate\Database\Seeder;

class BugStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BugStatus::insert([
            ['name' => 'New'],
            ['name' => 'Looking Into'],
            ['name' => 'Squashed']
        ]);
    }
}
