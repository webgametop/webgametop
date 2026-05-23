<?php

declare(strict_types=1);

namespace App\Enums;

enum RatingType: string
{
    case UPVOTE = 'upvote';
    case DOWNVOTE = 'downvote';
}
