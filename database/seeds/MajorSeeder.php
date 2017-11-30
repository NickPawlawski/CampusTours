<?php

use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Major::class,1)->create([
            'name' => 'Computer Science',
            'code' => 'csg',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Other',
            'code' => 'other',
            'undergraduate' => 0,
            'graduate' => 0,
            'active' => 1
        ]);
    }
}
