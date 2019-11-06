<?php

namespace App\Utilities;

use App\Models\Link;
use App\Contracts\UrlShortenerContract;

class UrlShortener implements UrlShortnerContract
{
    public function make($url)
    {
        $link = Link::where('url', $url)->first();

        if(! $link) {
            $link = Link::create(['url' => $url]);
        }

        return $link;
    }

    public function byHash($hash)
    {
        $link = Link::where('hash', $hash)->first();

        if($link) {
            $link->increment('counter');
        }

        return $link;
    }
}
