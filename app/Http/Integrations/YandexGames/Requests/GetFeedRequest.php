<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetFeedRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct()
    {
    }

    public function resolveEndpoint(): string
    {
        return '/feed';
    }
}
