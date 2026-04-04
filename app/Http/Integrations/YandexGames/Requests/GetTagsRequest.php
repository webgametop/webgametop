<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTagsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $lang = 'ru'
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/tags';
    }

    protected function defaultBody(): array
    {
        return [
            'lang' => $this->lang,
        ];
    }
}
