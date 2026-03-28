<?php

declare(strict_types=1);

namespace App\Values\User;

use Illuminate\Contracts\Support\Arrayable;

class UserUpdateData implements Arrayable
{
    public function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    public function toArray()
    {
    }
}
