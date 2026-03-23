<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case LOCKED = 'locked';
    case DELETED = 'deleted';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('user_status.labels.pending'),
            self::ACTIVE => __('user_status.labels.active'),
            self::BLOCKED => __('user_status.labels.blocked'),
            self::LOCKED => __('user_status.labels.locked'),
            self::DELETED => __('user_status.labels.deleted'),
        };
    }

    public static function default(): self
    {
        return self::PENDING;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
