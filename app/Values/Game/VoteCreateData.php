<?php

declare(strict_types=1);

namespace App\Values\Game;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

final readonly class VoteCreateData implements Arrayable
{
    public function __construct(
        private int $game_id,
        private int $user_id,
        private string $created_via,
    )
    {
    }

    public static function make(
        int $game_id,
        int $user_id,
        string $created_via,
    ) : self
    {
        return new self($game_id, $user_id, $created_via);
    }

    public function toArray(): array
    {
        return [
            'game_id' => $this->game_id,
            'user_id' => $this->user_id,
            'voted_at' => Carbon::now(),
            'created_via' => $this->created_via,
        ];
    }
}
