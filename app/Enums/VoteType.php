<?php

declare(strict_types=1);

namespace App\Enums;

enum VoteType: string
{
    case DAILY = 'daily';
    case ONLY = 'only';
    case SMS = 'sms';
}
