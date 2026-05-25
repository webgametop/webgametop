<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GamesPopular extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $q = Game::query();

        $games = $q
            ->with('developer')
            ->withVotesCount()
            ->withViewsCount()
            ->withFavoritesCount()
            ->withRatingSummary(true)
            ->selectRaw($s =
                "0.2 * LOG2(COALESCE(views_count, 0) + 1) +
                0.4 * LOG2(COALESCE(favorites_count, 0) + 1) +
                0.4 * (
                    CASE
                        WHEN (likes_count + dislikes_count) = 0 THEN 0
                        ELSE (
                            (
                                (likes_count + 1.9208) / (likes_count + dislikes_count) - 1.96 * SQRT(
                                    (likes_count * dislikes_count) / (likes_count + dislikes_count) + 0.9604
                                ) / (likes_count + dislikes_count)
                            ) / (1 + 3.8416 / (likes_count + dislikes_count))
                        ) * 100
                    END
                ) as popularity"
            )
            ->orderBy('popularity', 'desc')
            ->orderBy('released_at', 'desc')
            ->limit(5)
            ->get();

        return view('components.games-popular', compact('games'));
    }
}
