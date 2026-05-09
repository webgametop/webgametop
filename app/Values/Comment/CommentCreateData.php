<?php

declare(strict_types=1);

namespace App\Values\Comment;

use Illuminate\Contracts\Support\Arrayable;

final readonly class CommentCreateData implements Arrayable
{
    public function __construct(
        private string $commentable_type,
        private int $commentable_id,
        private ?int $parent_id,
        private int $user_id,
        private string $body,
    )
    {
    }

    public static function make(
        string $commentable_type,
        int $commentable_id,
        ?int $parent_id,
        int $user_id,
        string $body
    ) : self
    {
        return new self(
            $commentable_type,
            $commentable_id,
            $parent_id,
            $user_id,
            $body,
        );
    }

    public function getCommentableType(): string
    {
        return $this->commentable_type;
    }

    public function getCommentableId(): int
    {
        return $this->commentable_id;
    }

    /**
     * @return array{
     *     parent_id: ?int,
     *     user_id: int,
     *     body: string,
     * }
     */
    public function toArray(): array
    {
        return [
            'parent_id' => $this->parent_id,
            'user_id' => $this->user_id,
            'body' => $this->body,
        ];
    }
}
