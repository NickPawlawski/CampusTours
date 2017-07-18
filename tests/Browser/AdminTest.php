<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Tour;

class AdminTest extends DuskTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testMainPanel()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin')
                ->assertSeeLink('Tours')
                ->clickLink('Tours')
                ->assertPathIs('/campustours2/admin/tours');
        });
    }

    public function testToursPanel()
    {
        $this->tour = factory(Tour::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/tours')
                ->assertSee('Tour Time')
                ->assertSee($this->tour->tourtime->toDateTimeString()); // Assert that a table row exists for the tour
        });
    }
}
