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
            'name' => 'Aerospace Engineering',
            'code' => 'AE',
            'undergraduate' => 1,
            'graduate' => 0,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Chemical Engineering',
            'code' => 'CHEME',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Civil Engineering',
            'code' => 'CE',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Computer Engineering',
            'code' => 'COE',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Computer Science',
            'code' => 'CS',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Construction Engineering',
            'code' => 'CONE',
            'undergraduate' => 1,
            'graduate' => 0,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Electrical Engineering',
            'code' => 'EE',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Engineering Design Technology',
            'code' => 'EDT',
            'undergraduate' => 1,
            'graduate' => 0,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Engineering Managemnet Technology',
            'code' => 'EMT',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Graphic and Printing Science',
            'code' => 'GPS',
            'undergraduate' => 1,
            'graduate' => 0,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Industrial and Entrepreneurial Engineering',
            'code' => 'IEE',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Manufacturing Engineering Technology',
            'code' => 'MET',
            'undergraduate' => 1,
            'graduate' => 0,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Mechanical Engineering',
            'code' => 'ME',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Paper Engineering',
            'code' => 'PE',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Undecided Engineering',
            'code' => 'UND',
            'undergraduate' => 1,
            'graduate' => 0,
            'active' => 1
        ]);
        factory(\App\Major::class,1)->create([
            'name' => 'Manufacturing Engineering',
            'code' => 'MANE',
            'undergraduate' => 1,
            'graduate' => 1,
            'active' => 1
        ]);
    }
}
