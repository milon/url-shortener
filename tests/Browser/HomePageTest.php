<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_homepage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('URL Shortener');
        });
    }

    /** @test */
    public function it_can_shorten_an_url()
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

    /** @test */
    public function it_redirect_a_shorten_url_to_original_url()
    {
        $url = 'https://milon.im/';
        $this->browse(function (Browser $browser) use ($url) {
            $browser->visit('/')
                    ->type('url', $url)
                    ->press('Shorten URL')
                    ->assertVisible('#hash-link')
                    ->visit($browser->attribute('#hash-link', 'href'))
                    ->assertUrlIs($url);
        });
    }
}
