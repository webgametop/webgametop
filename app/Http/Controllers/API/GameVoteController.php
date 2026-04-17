<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\GameVoteStoreRequest;
use App\Models\Game;
use App\Services\GameVoteService;
use App\Values\Game\VoteRegisterData;
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
    public function index()
    {
        //
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
    public function store(GameVoteStoreRequest $request, Game $game)
    {
        $dto = new VoteRegisterData(
            $game->id,
            $request->input('key'),
            'api'
        );

        try {
            $this->service->registerVote($dto);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
