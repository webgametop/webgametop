<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\HashingFormat as FormatEnum;
use App\Http\Controllers\Controller;
use App\Models\View;
use App\Services\Security\HmacHasherService;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function __construct(
        private readonly HmacHasherService $hasherService
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
        $user_id = auth()->check() ? auth()->id() : sha1(request()->ip() . request()->userAgent());

        $viewable_type = $request->input('viewable_type');
        $viewable_id = $request->input('viewable_id');

        $window_size = 1800;
        $window_start = intdiv(now()->timestamp, $window_size);

        $dedup_string = implode('|', [$user_id, $viewable_type, $viewable_id, $window_start]);
        $dedup_hash = $this->hasherService->hash($dedup_string, FormatEnum::BINARY);

        try {
            if (! View::query()->where('dedup_hash', $dedup_hash)->exists()) {
                $model = app($viewable_type)->find($viewable_id);
                $model->views()->save(View::make(['dedup_hash' => $dedup_hash]));

                return response()->json(['ok' => true, 'description' => 'View has been recorded successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'description' => 'Bad Request.'], 500);
        }

        return response()->json(['ok' => false, 'description' => 'Duplicate view within the current time window.']);
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
