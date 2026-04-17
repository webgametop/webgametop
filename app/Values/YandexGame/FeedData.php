<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Saloon\Http\Response;

class FeedData implements Arrayable
{
    /**
     * @param Collection<FeedDataItem> $games
     * @param FeedDataPageInfo $pageInfo
     */
    public function __construct(
        public readonly Collection $games,
        public readonly FeedDataPageInfo $pageInfo,
    )
    {
    }

    public static function fromSaloonResponse(Response $response): self
    {
        $games = new Collection;

        /**
         * @var array{
         *     feed: array<array>,
         *     pageInfo: array,
         *     gamesWithPromos: int,
         *     shareImage: string,
         *     siteNavigationLinks: array<array{
         *         name: string,
         *         url: string,
         *     }>,
         *     gamesRequestId: string,
         * } $json
         */
        $json = $response->json();

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
         *     type: string,
         *     size: string,
         *     items: array<array>,
         *     isFromFirstPage: bool,
         *     requestId: string,
         * }> $feed
         */
        $feed = $json['feed'];

        /**
         * @var array{
         *     type: string,
         *     size: string,
         *     items: array<array>,
         *     isFromFirstPage: bool,
         *     requestId: string
         * } $suggested
         */
        $suggested = current(array_filter($feed ?? [], fn($item) => $item['type'] === 'suggested'));

        /**
         * @var array<array> $items
         */
        $items = $suggested['items'] ?? [];

        /**
         * @var array{
         *     developer: array,
         *     categoryIDs: int[],
         *     title: string,
         *     appSlug: string,
         *     appID: int,
         *     ratingCount: int,
         *     media: array<array>,
         *     tagIDs: int[],
         *     gqRating: int,
         *     features: array,
         *     badge: array,
         *     column: int,
         *     row: int,
         *     requestId: string,
         * } $item
         */
        foreach ($items as $item) {
            /**
             * @var array{
             *     name: string,
             *     id: int,
             * } $developer
             */
            $developer = $item['developer'];

            /**
             * @var array{
             *     cover: array,
             *     icon: array,
             *     videos: array<array>
             * } $media
             */
            $media = $item['media'];

            /**
             * @var array{
             *     prefix-url: string,
             *     mainColor: string,
             * } $media_cover
             */
            $media_cover = $media['cover'];

            /**
             * @var array{
             *     prefix-url: string,
             *     mainColor: string,
             * } $media_icon
             */
            $media_icon = $media['icon'];

            /**
             * @var array<array{
             *     // @todo
             * }> $media_videos
             */
            $media_videos = $media['videos'];

            $games->add(new FeedDataItem(
                $item['appID'],
                $item['title'],
                new GameDeveloper(
                    $developer['id'],
                    $developer['name'],
                )
            ));
        }

        return new self($games, new FeedDataPageInfo(
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
