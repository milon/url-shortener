<?php

namespace App\Utilities;

use App\Contracts\UrlShortenerContract;
use App\Models\Link;

class UrlShortener implements UrlShortenerContract
{
    public function make($url): Link
    {
        $link = Link::where('url', $url)
            ->where('user_id', auth()->id())
            ->first();

        if (! $link) {
            $link = Link::create(['url' => $url]);
        }

        return $link;
    }

    public function byHash($hash): ?Link
    {
        return Link::where('hash', $hash)->first();
    }
}
