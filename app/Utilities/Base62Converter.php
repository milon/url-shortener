<?php

namespace App\Utilities;

class Base62Converter
{
    const BASE = '62';

    private static $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function encode(string $val): string
    {
        $str = '';
        do {
            $m = bcmod($val, self::BASE);
            $str = self::$chars[$m].$str;
            $val = bcdiv(bcsub($val, $m), self::BASE);
        } while (bccomp($val, '0') > 0);

        return $str;
    }

    public static function decode(string $str): int
    {
        $len = strlen($str);
        $val = 0;
        $arr = array_flip(str_split(self::$chars));
        for ($i = 0; $i < $len; $i++) {
            $val = bcadd($val, bcmul($arr[$str[$i]], bcpow(self::BASE, (string) ($len - $i - 1))));
        }

        return $val;
    }
}
