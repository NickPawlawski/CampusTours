<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Tour;
use Carbon\Carbon;

class TourModelTest extends TestCase
{
   	public function testDateTime()
    {
    	// Make a new tour without saving it.
    	$tour = factory(Tour::class)->make();

    	// Retrieve the date and time object.
    	$dateTime = $tour->dateTime();

    	$this->assertEquals($dateTime->format('Y-m-d H:i:s'), 
    		date('Y-m-d H:i:s', strtotime($tour->date->toDateString() . ' ' . $tour->time)));
    }
}
