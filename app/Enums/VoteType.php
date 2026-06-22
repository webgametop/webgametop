<?php

declare(strict_types=1);

namespace App\Enums;

use App\Services\Strategy\Contracts\VoteStrategy;
use App\Services\Strategy\VoteDailyStrategy;
use App\Services\Strategy\VoteOnlyStrategy;
use App\Services\Strategy\VoteSmsStrategy;
use Illuminate\Database\Eloquent\Model;

enum VoteType: string
{
    case DAILY = 'daily';
    case ONLY = 'only';
    case SMS = 'sms';

    /** @return class-string<VoteStrategy|Model> */
    public function strategyClass(): string
    {
        return match ($this) {
            self::DAILY => VoteDailyStrategy::class,
            self::ONLY => VoteOnlyStrategy::class,
            self::SMS => VoteSmsStrategy::class,
        };
    }
}
