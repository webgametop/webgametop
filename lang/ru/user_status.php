<?php

declare(strict_types=1);

use App\Enums\UserStatus as Status;

return [

    'labels' => array_combine(Status::values(), [
        'ожидает подтверждения',
        'активен',
        'заблокирован',
        'доступ ограничен',
        'удалён',
    ]),

];
