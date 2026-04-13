<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Developer;
use App\Models\Game;
use App\Models\User;
use App\Services\GameVoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct(
        private readonly GameVoteService $voteService,
    )
    {
    }

    public function showcase()
    {
        return view('web.games.showcase');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GameProviderEnum $provider)
    {
        $games = Game::with('developer')
            ->whereRelation('developer', 'provider', $provider)
            ->orderBy('released_at', 'desc')
            ->paginate(30);

        return view('web.games.index', compact('games', 'provider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        /** @var Developer $developer */
        $developer = $game->developer;
        /** @var GameProviderEnum $provider */
        $provider = $developer->provider;

        /** @var User $user */
        $user = \Auth::user();

        $this->voteService->payloadVote($game, $user); // regeneratePayload

        return view('web.games.card.index', compact('game', 'developer', 'provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }

    public function redirect(?Game $game): RedirectResponse
    {
        if (! $game) {
            abort(404, 'The requested user does not exist.');
        }

        return redirect()->route('games.show', [$game, $game->slug]);
    }
}
