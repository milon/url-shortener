<?php

namespace App\Utilities;

use App\Contracts\UrlShortenerContract;
use App\Models\Link;
use Illuminate\Support\Str;

class UrlShortenerService implements UrlShortenerContract
{
    public function make(string $url, string $hash = null): Link
    {
        $link = Link::where('url', $url)
            ->when($hash, function ($query) use ($hash) {
                $query->where('hash', $hash);
            })
            ->where('user_id', auth()->id())
            ->first();

        if ($link) {
            return $link;
        }

        if (! $hash) {
            $hash = HashGenerator::create($url);

            if (Link::where('hash', $hash)->exists()) {
                $hash = Str::random(6);
            }
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
