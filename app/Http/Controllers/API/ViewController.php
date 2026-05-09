<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ViewStoreRequest;
use App\Models\Contracts\Viewable;
use App\Models\View;
use App\Services\ViewService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function __construct(
        private readonly ViewService $service,
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
    public function store(ViewStoreRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $modelType = Relation::getMorphedModel($dto->getViewableType());

        /** @var Viewable|Model $entity */
        $entity = $modelType::findOrFail($dto->getViewableId());

        $view = View::make($dto->toArray());

        try {
            $this->service->registerView($entity, $view);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'description' => $e->getMessage()], $e->getCode());
        }

        return response()->json(['ok' => true, 'description' => 'View has been recorded successfully.']);
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
