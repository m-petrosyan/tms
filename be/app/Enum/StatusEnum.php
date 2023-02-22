<?php

namespace App\Enum;

enum StatusEnum: int
{
    case TODO = 0;
    case DOING = 1;
    case CODEREVIEW = 2;
    case DONE = 3;

    public static function getValues(): array
    {
        foreach (self::cases() as $case) {
            $array[] = $case->value;
        }

        return $array;
    }
}

