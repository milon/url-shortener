<?php

namespace App\Utilities;

use App\Models\Link;
use App\Contracts\UrlShortenerContract;

class UrlShortener implements UrlShortenerContract
{
    public function make($url): Link
    {
        $link = Link::where('url', $url)
            ->where('user_id', auth()->id())
            ->first();

        if(! $link) {
            $link = Link::create(['url' => $url]);
        }

        return $link;
    }

    public function byHash($hash): ?Link
    {
        return Link::where('hash', $hash)->first();
    }
}
