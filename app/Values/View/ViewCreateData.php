<?php

declare(strict_types=1);

namespace App\Values\View;

use Illuminate\Contracts\Support\Arrayable;

final readonly class ViewCreateData implements Arrayable
{
    public function __construct(
        private string $viewable_type,
        private int $viewable_id,
        private ?int $user_id,
        private string $dedup_hash,
    )
    {
    }

    public static function make(
        string $viewable_type,
        int $viewable_id,
        ?int $user_id,
        string $dedup_hash,
    ) : self
    {
        return new self(
            $viewable_type,
            $viewable_id,
            $user_id,
            $dedup_hash,
        );
    }

    public function getViewableType(): string
    {
        return $this->viewable_type;
    }

    public function getViewableId(): int
    {
        return $this->viewable_id;
    }

    /**
     * @return array{
     *     user_id: ?int,
     *     dedup_hash: string,
     * }
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'dedup_hash' => $this->dedup_hash,
        ];
    }
}
