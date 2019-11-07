<?php

namespace App\Utilities;

use App\Link;
use App\Contracts\UrlShortenerContract;

class UrlShortener implements UrlShortenerContract
{
    public function make($url)
    {
        $link = Link::where('url', $url)
            ->where('user_id', auth()->id())
            ->first();

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
