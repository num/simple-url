<?php

namespace App\Helpers;

use App\Models\Url;

class Base62
{
    private const CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function random(int $length = 6): string
    {
        $base = strlen(self::CHARS);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= self::CHARS[random_int(0, $base - 1)];
        }
        return $result;
    }

    public static function generateUnique(int $length = 6, int $maxAttempts = 10): string
    {
        $count = 0;

        do {
            $code = self::random($length);
            $count++;

            if ($count >= $maxAttempts) {
                throw new \RuntimeException('Failed to generate unique Base62 code after ' . $maxAttempts . ' attempts');
            }
        } while (Url::where('short_url', $code)->exists());

        return $code;
    }
}
