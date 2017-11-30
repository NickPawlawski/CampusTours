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
        $tours = DB::table('tours')->pluck('id')->toArray();
        $studentTypes = DB::table('student_status')->pluck('id')->toArray();
        factory(App\Attendee::class, 10)->create([
            'tour_id' => $faker->randomElement($tours),
            'studentType' => $faker->randomElement($studentTypes),
            
        ]);
    }
}
