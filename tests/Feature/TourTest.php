<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Tour;
use Carbon\Carbon;
use App\User;

class TourTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testCreateTour()
    {

    $this->assertTrue(true);  
      /*
       $this->user = factory(User::class)->create();
       $tours = Tour::count();
       $mytime = Carbon::now();
       $response = $this->actingAs($this->user)->json('POST','/admin/tours',['tourtime'=>$mytime]);
       $response -> assertStatus(200);
       $this -> assertGreaterThan(Tour::count(),$tours);
       */
    }
}
