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
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 1)->create([
            'email' => 'test@test.com',
            'username' => 'test'
        ]);
        
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
        
        App\StudentStatus::insert([
            ['name' => 'Transfer'],
            ['name' => 'Undergraduate'],
            ['name' => 'Graduate'],
            ['name' => 'other']
        ]);
        
        
    }
}
