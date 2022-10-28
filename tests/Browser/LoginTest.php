<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPSTORM_META\type;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->type('#name', "Marce")
            ->type()
            ->type('#email', "mars@mars.com")
            ->type('#password',"123456")
            ->press('button.inline-flex')
            ->pause(5000);
            $browser->assertPathIs(route('store'));
        });
    }
}
