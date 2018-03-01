<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
                'attended' => 0,
                'startTerm' => 0,
                'major' => $faker->randomElement($majors),
                'visited' => 0,
                'viewable' => 0
                
            ]);
        }

        $tours = DB::table('tours')->pluck('id')->toArray();
        $studentTypes = DB::table('student_status')->pluck('id')->toArray();
        $majors = DB::table('majors')->pluck('id')->toArray();

        App\Attendee::insert([
            'firstName' => "Nick",
            'lastName' => "Pawlawski",
            'email' => "nicholas.a.pawlawski@wmich.edu",
            'visitors'=> $faker->randomDigit,
            'phone' => $faker->tollFreePhoneNumber,
            'considerations' => $faker->text,
            'token' => str_random(16),

            'tour_id' => $faker->randomElement($tours),
            'attended' => 0,
            'startTerm' => 0,
            'major' => $faker->randomElement($majors),
            'visited' => 0,
            'viewable' => 0
        ]);
        
    }
}
