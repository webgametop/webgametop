<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\GameVoteExpiredException;
use App\Http\Controllers\Controller;
use App\Services\GameVoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    public function store(Request $request)
    {
        /** @var string $key */
        $key = $request->key;

        try {
            /** @var ?string $cached */
            if (! $cached = Cache::get($key)) {
                throw new GameVoteExpiredException;
            }

            /**
             * @var array{
             *     sub: int,
             *     iat: int,
             *     exp: int,
             *     user: array{
             *         id: int,
             *     }
             * } $payload
             */
            $payload = json_decode($cached, true);

            $this->service->registerVote($payload['user']['id'], 'api');
        } catch (\Exception $e) {
            return ['ok' => false, 'message' => $e->getMessage()];
        }

        return ['ok' => true];
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
