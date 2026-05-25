<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Enums\GameProvider;
use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GamesLatest extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private readonly GameProvider $provider,
    )
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
            ->whereProvider($this->provider)
            ->orderBy('released_at', 'desc')
            ->limit(5)
            ->get();

        return view('components.games-latest', compact('games'));
    }
}
