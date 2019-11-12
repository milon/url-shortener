<?php

namespace Tests\Unit;

use App\Contracts\UrlShortenerContract;
use App\Models\Link;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlShortnerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $urlShortener;
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->urlShortener = app(UrlShortenerContract::class);
    }

    /** @test */
    public function it_create_a_shorten_url()
    {
        $url = $this->faker->url;

        $link = $this->urlShortener->make($url);

        $this->assertInstanceOf(Link::class, $link);
        $this->assertEquals($url, $link->url);
    }

    /** @test */
    public function it_create_the_same_link_for_same_hash()
    {
        $url = $this->faker->url;

        $link1 = $this->urlShortener->make($url);
        $link2 = $this->urlShortener->make($url);

        $this->assertEquals($link1->hash, $link2->hash);
    }

    /** @test */
    public function it_return_different_hash_for_same_url_for_different_user()
    {
        $url = $this->faker->url;

        $link1 = $this->urlShortener->make($url);

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $link2 = $this->urlShortener->make($url);

        $this->assertEquals($link1->url, $link2->url);
        $this->assertNotEquals($link1->hash, $link2->hash);
    }

    /** @test */
    public function it_can_unshorten_a_hashed_url()
    {
        $url = $this->faker->url;

        $hashedLink = $this->urlShortener->make($url);

        $unhashedLink = $this->urlShortener->byHash($hashedLink->hash);

        $this->assertEquals($url, $unhashedLink->url);
    }
}
