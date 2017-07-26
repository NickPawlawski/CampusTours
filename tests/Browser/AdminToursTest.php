<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Tour;
use App\User;

class AdminTourTest extends DuskTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testToursPanel()
    {
        Tour::truncate();

        $this->tour = factory(Tour::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/tours')
                    ->assertSee('Tour Time')
                    // Assert that a table row exists for the tour
                    ->assertSee(date('m/d/Y h:m A', $this->tour->tourtime->timestamp)); 
        });
    }

    public function testAddTour()
    {
        Tour::truncate();

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/tours')
                    ->value('#addDate', '01/01/2020')
                    ->value('#addTime', '12:00 PM')
                    ->press('Add Tour');

            $browser->loginAs($this->user)
                    ->visit('/admin/tours')
                    ->assertSee('01/01/2020')
                    ->assertSee('12:00 PM');
        });
    }
}
