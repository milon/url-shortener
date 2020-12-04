<?php

namespace App\Utilities;

class HashGenerator
{
    public static function create(string $url): string
    {
        $numericHash = crc32($url);

        return Base62Converter::encode((string) $numericHash);
    }
}
