<?php

use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Term::insert([
            ['name' => 'Fall'],
            ['name' => 'Spring'],
            ['name' => 'Summer 1'],
            ['name' => 'Summer 2'],
            ['name' => 'Undecided']
        ]);
    }
}
