<?php

declare(strict_types=1);

namespace App\Values\Game;

use Illuminate\Contracts\Support\Arrayable;

final readonly class VoteRegisterData implements Arrayable
{
    public function __construct(
        private int $sub,
        private string $key,
        private string $via = 'web',
    )
    {
    }

    public static function make(
        int $sub,
        string $key,
        string $via = 'web'
    ) : self
    {
        return new self($sub, $key, $via);
    }

    public function sub(): int
    {
        return $this->sub;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function via(): string
    {
        return $this->via;
    }

    public function toArray(): array
    {
        return [
            'sub' => $this->sub,
            'key' => $this->key,
            'via' => $this->via,
        ];
    }
}
