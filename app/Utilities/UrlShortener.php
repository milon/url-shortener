<?php

namespace App\Utilities;

use App\Models\Link;
use App\Contracts\UrlShortenerContract;
use Jenssegers\Agent\Agent;

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
            $agent = new Agent;
            $link->visitors()->create([
                'os'      => $agent->platform(),
                'ip'      => request()->ip(),
                'device'  => $agent->device(),
                'browser' => $agent->browser(),
            ]);
        }

        return $link;
    }
}
