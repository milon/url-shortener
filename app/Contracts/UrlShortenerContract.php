<?php

namespace App\Contracts;

interface UrlShortenerContract
{
    public function make($url);

    public function byHash($hash);
}
