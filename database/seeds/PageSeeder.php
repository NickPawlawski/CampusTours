<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Page::insert([
            ['name' => 'Tours'],
            ['name' => 'Majors'],
            ['name' => 'Attendees'],
            ['name' => 'Users'],
            ['name' => 'Report'],
            ['name' => 'Attendee'],
            ['name' => 'Other']  
        ]);
    }
}
