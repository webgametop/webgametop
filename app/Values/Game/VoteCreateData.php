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
        private ?string $name_ca = null,
    )
    {
    }

    public static function make(
        int $game_id,
        int $user_id,
        ?string $name_ca = null
    ) : self
    {
        return new self($game_id, $user_id, $name_ca);
    }

    public function toArray(): array
    {
        return [
            'game_id' => $this->game_id,
            'user_id' => $this->user_id,
            'vote_dt' => Carbon::now(),
            'name_ca' => $this->name_ca,
        ];
    }
}
