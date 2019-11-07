<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends DuskTestCase
{
    public function testHomePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('URL Shortener');
        });
    }

    public function testShortenAnUrl()
    {
        $url = 'http://test-domain-name.tld';
        $this->browse(function (Browser $browser) use ($url) {
            $browser->visit('/')
                ->type('url', $url)
                ->press('Shorten URL')
                ->assertPathIs('/')
                ->assertSee('Here you go-');
        });
    }
}
