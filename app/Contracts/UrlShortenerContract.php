<?php

namespace App\Contracts;

use App\Models\Link;

interface UrlShortenerContract
{
    public function make(string $url): Link;

    public function byHash(string $hash): ?Link;
}
