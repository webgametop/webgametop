<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Http\Response;

class GamesData implements Arrayable
{
    public function __construct()
    {
    }

    public static function fromSaloonResponse(Response $response): self
    {
        $json = $response->json();

        /**
         * @var array<array{
         *     developer: array,
         *     categoryIDs: int[],
         *     title: string,
         *     appSlug: string,
         *     appID: int,
         *     ratingCount: int,
         *     rating: int,
         *     url: string,
         *     categoriesNames: string[],
         *     description: string,
         *     seoDescription: string,
         *     generatedTitle: string,
         *     seoTitle: string,
         *     media: array,
         *     features: array,
         *     tagIDs: int[],
         *     score: int,
         *     premiumDescription: string,
         *     minLoadTime: float,
         *     firstPublished: int,
         *     extraFeatures: array,
         *     badge: array,
         * }> $games
         */
        $games = $json['games'];

        foreach ($games as $game) {
            /**
             * @var array{
             *     name: string,
             *     id: int,
             * } $developer
             */
            $developer = $game['developer'];

            /**
             * @var array{
             *     cover: array,
             *     icon: array,
             *     maskableIcon: array,
             *     videos: array,
             * } $media
             */
            $media = $game['media'];

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
             * @var array{
             *     prefix-url: string,
             *     mainColor: string,
             * } $media_maskableIcon
             */
            $media_maskableIcon = $media['maskableIcon'];

            /**
             * @var array<array> $videos
             */
            $videos = $media['videos'];

            /**
             * @var array{
             *     embedUrl: string,
             *     thumbnailUrl: string,
             *     thumbnailUrlPrefix: string,
             *     streamUrl: string,
             *     previewUrl: string,
             *     mp4StreamUrl: string,
             *     height: int,
             *     width: int,
             * } $video
             */
            foreach ($videos as $video) {
                //
            }

            //
        }

        dd($json);

        return new self();
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
