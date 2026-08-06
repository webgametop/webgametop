<?php

declare(strict_types=1);

namespace App\Enums;

enum ReportReason: string
{
    case SPAM = 'spam';
    case ABUSE = 'abuse';
    case PROFANITY = 'profanity';
    case PERSONAL_DATA = 'personal_data';
    case OTHER = 'other';
}
