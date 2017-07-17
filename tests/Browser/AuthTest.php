<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AuthTest extends DuskTestCase
{
    //use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', $this->user->email)
                ->type('password', 'secret')
                ->press('login')
                ->assertPathIs('/campustours2/admin');
        });
    }
}
