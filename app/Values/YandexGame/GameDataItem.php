<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use App\Values\YandexGame\GameMedia\GameMedia;
use App\Values\YandexGame\GameMedia\GameMediaCover;
use App\Values\YandexGame\GameMedia\GameMediaIcon;
use App\Values\YandexGame\GameMedia\GameMediaScreenshot;
use App\Values\YandexGame\GameMedia\GameMediaVideo;
use Illuminate\Support\Collection;

class GameDataItem
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $description,
        public readonly GameDeveloper $developer,
        public readonly GameMedia $media,
    )
    {
    }

    /**
     * @param array{
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
     * } $game
     * @return self
     */
    public static function make(array $game): self
    {
        /**
         * @var Collection<GameMediaVideo> $videos
         */
        $videos = new Collection;

        /**
         * @var Collection<GameMediaScreenshot> $screenshots
         */
        $screenshots = new Collection;

        /**
         * @var array{
         *     name: string,
         *     id: int,
         * } $game_developer
         */
        $game_developer = $game['developer'];

        /**
         * @var array{
         *     cover: array,
         *     icon: array,
         *     videos: array,
         * } $game_media
         */
        $game_media = $game['media'];

        /**
         * @var array{
         *     prefix-url: string,
         *     mainColor: string,
         * } $game_media_cover
         */
        $game_media_cover = $game_media['cover'];

        /**
         * @var array{
         *     prefix-url: string,
         *     mainColor: string,
         * } $game_media_icon
         */
        $game_media_icon = $game_media['icon'];

        /**
         * @var array<array> $game_media_videos
         */
        $game_media_videos = $game_media['videos'];

        /**
         * @var array{
         *     mobile: array<array>,
         *     desktop: array<array>,
         * } $game_media_screenshots
         */
        $game_media_screenshots = $game_media['screenshots'];

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
        foreach ($game_media_videos as $video) {
            $videos->add(new GameMediaVideo(
                $video['embedUrl'],
                $video['thumbnailUrl'],
                $video['thumbnailUrlPrefix'],
                $video['streamUrl'],
                $video['previewUrl'],
                $video['mp4StreamUrl'],
                $video['height'],
                $video['width'],
            ));
        }

        /**
         * @var string $device desktop or mobile
         * @var array<array> $items
         */
        foreach ($game_media_screenshots as $device => $items) {
            /**
             * @var array{
             *     prefix-url: string,
             *     mainColor: string,
             *     orientation: string,
             * } $screenshot
             */
            foreach ($items as $screenshot) {
                $screenshots->add(new GameMediaScreenshot(
                    $screenshot['prefix-url'],
                    $screenshot['mainColor'],
                    $screenshot['orientation'],
                    $device
                ));
            }
        }

        $developer = new GameDeveloper(
            $game_developer['id'],
            $game_developer['name'],
        );

        $mediaCover = new GameMediaCover(
            $game_media_cover['prefix-url'],
            $game_media_cover['mainColor'],
        );

        $mediaIcon = new GameMediaIcon(
            $game_media_icon['prefix-url'],
            $game_media_icon['mainColor'],
        );

        $media = new GameMedia(
            $mediaCover,
            $mediaIcon,
            $videos,
            $screenshots,
        );

        return new self(
            $game['appID'],
            $game['title'],
            $game['description'],
            $developer,
            $media,
        );
    }
}
