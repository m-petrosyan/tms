<?php

namespace App\Enum;

enum StatusEnum: int
{
    case TODO = 0;
    case DOING = 1;
    case CODEREVIEW = 2;
    case DONE = 3;
}
