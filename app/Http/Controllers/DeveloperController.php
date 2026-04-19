<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Builders\DeveloperBuilder;
use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Developer;
use App\Models\Game;
use App\Services\GameStats\ProviderStat as GameProviderStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DeveloperController extends Controller
{
    public function __construct(
        private readonly GameProviderStat $providerStat,
    )
    {
    }

    public function showcase()
    {
        $stats = $this->providerStat->countDevelopers();

        return view('web.developers.showcase', compact('stats'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GameProviderEnum $provider)
    {
        /** @var DeveloperBuilder $q */
        $q = Developer::query();

        $developers = $q->ofProvider($provider)->orderBy('created_at', 'desc')->paginate(30);

        return view('web.developers.index', compact('developers', 'provider'));
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
    public function show(Developer $developer)
    {
        /** @var Collection<Game> $games */
        $games = $developer->games;
        /** @var GameProviderEnum $provider */
        $provider = $developer->provider;

        return view('web.developers.card.index', compact('developer', 'games', 'provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Developer $developer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Developer $developer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        //
    }

    public function redirect(?Developer $developer): RedirectResponse
    {
        if (! $developer) {
            abort(404, 'The requested user does not exist.');
        }

        return redirect()->route('developers.show', [$developer, $developer->slug]);
    }
}
