<?php

namespace App\Contract;

interface UrlShortnerContract
{
    public function make($url);

    public function byHash($hash);
}
