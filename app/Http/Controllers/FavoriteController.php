<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteToggleRequest;
use App\Models\Contracts\Favoriteable;
use App\Services\FavoriteService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct(
        private readonly FavoriteService $service,
    )
    {
    }

    public function toggle(FavoriteToggleRequest $request)
    {
        $modelType = Relation::getMorphedModel($request->input('favoriteable.type'));

        /** @var Model|Favoriteable $entity */
        $entity = $modelType::findOrFail($request->input('favoriteable.id'));

        try {
            $favorite = $this->service->toggleFavorite($entity, auth()->user());
        } catch (\Exception $e) {
            return redirect()->back()->with('flash', [
                'type' => 'danger', 'message' => $e->getMessage()
            ]);
        }

        if (! $favorite) {
            return redirect()->back()->with('flash', [
                'type' => 'info', 'message' => 'Successfully removed from favorites.'
            ]);
        }

        return redirect()->back()->with('flash', [
            'type' => 'success', 'message' => 'Successfully added to favorites.'
        ]);
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
        //
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
