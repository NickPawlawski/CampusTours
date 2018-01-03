<?php

use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0;$i < 10;$i++)
        {
            $tours = DB::table('tours')->pluck('id')->toArray();
            $studentTypes = DB::table('student_status')->pluck('id')->toArray();
            $majors = DB::table('majors')->pluck('id')->toArray();
            factory(App\Attendee::class, 3)->create([
                'tour_id' => $faker->randomElement($tours),
                'studentType' => $faker->randomElement($studentTypes),
                'attended' => 0,
                'startTerm' => 0,
                'major' => $faker->randomElement($majors),
                'visited' => 0,
                'viewable' => 0
                
            ]);
        }
        
    }
}
