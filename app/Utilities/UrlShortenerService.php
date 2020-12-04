<?php

namespace App\Utilities;

use App\Contracts\UrlShortenerContract;
use App\Models\Link;
use Illuminate\Support\Str;

class UrlShortenerService implements UrlShortenerContract
{
    public function make(string $url): Link
    {
        $link = Link::where('url', $url)
            ->where('user_id', auth()->id())
            ->first();

        if ($link) {
            return $link;
        }

        $hash = HashGenerator::create($url);

        if (Link::where('hash', $hash)->exists()) {
            $hash = Str::random(6);
        }

        return Link::create([
            'url' => $url,
            'hash' => $hash,
        ]);
    }

    public function byHash(string $hash): ?Link
    {
        return Link::where('hash', $hash)->first();
    }
}
