<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Game;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GamesFavorite extends Component
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
    public function render(): View|Closure|string
    {
        $q = Game::query();

        $games = $q
            ->with('developer')
            ->withFavoritesCount()
            ->orderBy('favorites_count', 'desc')
            ->orderBy('released_at', 'desc')
            ->limit(5)
            ->get();

        return view('components.games-favorite', compact('games'));
    }
}
