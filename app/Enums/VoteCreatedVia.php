<?php

declare(strict_types=1);

namespace App\Enums;

enum VoteCreatedVia: string
{
    case WEB = 'web';
    case API = 'api';
}
