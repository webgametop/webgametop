<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Developer;
use App\Models\Game;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class GameVoteController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Game $game)
    {
        /** @var Developer $developer */
        $developer = $game->developer;
        /** @var GameProviderEnum $provider */
        $provider = $developer->provider;

        /** @var User $user */
        $user = auth()->user();

        $vote_info = $this->userService->getDailyVoteInfo($user, $game);

        return view('web.games.card.votes', compact(['game', 'provider', 'vote_info']));
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
    public function store(Request $request, Game $game)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
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
}
