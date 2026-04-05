<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Saloon\Http\Response;

class FeedData implements Arrayable
{
    /**
     * @param Collection<FeedGame> $games
     * @param FeedPageInfo $page_info
     */
    public function __construct(
        public readonly Collection $games,
        public readonly FeedPageInfo $page_info,
    )
    {
    }

    public static function fromSaloonResponse(Response $response): self
    {
        $json = $response->json();

        /**
         * @var array{
         *     type: string,
         *     size: string,
         *     items: array<array>,
         *     isFromFirstPage: bool,
         *     requestId: string
         * } $suggested
         */
        $suggested = current(array_filter($json['feed'], fn($item) => $item['type'] === 'suggested'));

        /**
         * @var array{
         *     nextPageId: string,
         *     rtxReqId: string,
         *     isFirstPage: bool,
         *     hasNextPage: bool,
         * } $page_info
         */
        $page_info = $json['pageInfo'];

        /**
         * @var array<array{
         *     developer: array{
         *         name: string,
         *         id: int,
         *     },
         *     categoryIDs: int[],
         *     title: string,
         *     appSlug: string,
         *     appID: int,
         *     ratingCount: int,
         *     rating: int,
         *     media: array{
         *         cover: array{
         *             prefix-url: string,
         *             mainColor: string,
         *         },
         *         icon: array{
         *             prefix-url: string,
         *             mainColor: string,
         *         },
         *         videos: array<array>,
         *     },
         *     tagIDs: int[],
         *     gqRating: int,
         *     features: array,
         *     badge: array,
         *     column: int,
         *     row: int,
         *     requestId: string,
         * }> $items
         */
        $items = $suggested['items'];

        $games = new Collection;

        foreach ($items as $item) {
            /**
             * @var array{
             *     name: string,
             *     id: int,
             * } $developer
             */
            $developer = $item['developer'];
            $games->add(new FeedGame(
                $item['appID'],
                $item['title'],
                new GameDeveloper(
                    $developer['id'],
                    $developer['name'],
                )
            ));
        }

        return new self($games, new FeedPageInfo(
            $page_info['nextPageId'],
            $page_info['rtxReqId'],
            $page_info['isFirstPage'],
            $page_info['hasNextPage'],
        ));
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
