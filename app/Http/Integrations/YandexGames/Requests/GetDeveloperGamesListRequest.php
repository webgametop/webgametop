<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetDeveloperGamesListRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $developer_id,
        public readonly ?string $page_id,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/developer_games';
    }

    protected function defaultQuery(): array
    {
        return [
            'lang' => 'ru',
            'tab' => 'new',
            'developer_id' => $this->developer_id,
            'page_id' => $this->page_id,
        ];
    }
}
