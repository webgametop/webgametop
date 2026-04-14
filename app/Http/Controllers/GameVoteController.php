<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Developer;
use App\Models\Game;
use App\Models\User;
use App\Services\GameVoteService;
use Illuminate\Http\Request;

class GameVoteController extends Controller
{
    public function __construct(
        private readonly GameVoteService $service,
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

        /** @var ?User $user */
        $user = \Auth::user();

        $process = $this->service->processVote($game, $user);

        return view('web.games.card.votes', compact('game', 'provider', 'process'));
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
        /** @var User $user */
        $user = \Auth::user();

        $route_data = [$game, $game->slug];
        $flash_data = ['message' => 'Thank you! Your vote has been counted. Come back tomorrow to vote again.', 'type' => 'success'];

        try {
            $this->service->registerVote($user->id);
        } catch (\Exception $e) {
            $flash_data['message'] = $e->getMessage();
            $flash_data['type'] = 'info';
        }

        return redirect()->route('games.votes', $route_data)->with('flash', $flash_data);
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
