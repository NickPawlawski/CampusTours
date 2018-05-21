<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MajorSeeder::class);
        $this->call(StudentStatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TourSeeder::class);
        $this->call(AttendeeSeeder::class);
        $this->call(TermSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(BugStatusSeeder::class);
    }
}
