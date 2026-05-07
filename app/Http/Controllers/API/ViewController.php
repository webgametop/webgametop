<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\HashingFormat as FormatEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ViewStoreRequest;
use App\Models\View;
use App\Services\Security\HmacHasherService;
use App\Services\ViewService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function __construct(
        private readonly ViewService $service,
        private readonly HmacHasherService $hasherService,
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
     * @todo move logic to service
     */
    public function store(ViewStoreRequest $request): JsonResponse
    {
        $payload = $request->extractRequestData();

        /** @var string $dedup_hash */
        $dedup_hash = $payload['dedup_hash'];
        /** @var string $viewable_type */
        $viewable_type = $payload['viewable_type'];
        /** @var int $viewable_id */
        $viewable_id = $payload['viewable_id'];
        /** @var ?int $user_id */
        $user_id = $payload['user_id'];

        try {
            if ($this->service->existsByHash($dedup_hash)) {
                return response()->json(['ok' => false, 'description' => 'Duplicate view within the current time window.'], 409);
            }

            $model = app($viewable_type)->findOrFail($viewable_id);
            $model->views()->save(View::make(['user_id' => $user_id, 'dedup_hash' => $dedup_hash]));

            return response()->json(['ok' => true, 'description' => 'View has been recorded successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['ok' => false, 'description' => 'Viewable model not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'description' => 'Internal Server Error.'], 500);
        }
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
