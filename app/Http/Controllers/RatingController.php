<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RatingStoreRequest;
use App\Models\Contracts\Rateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class RatingController extends Controller
{
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
    public function store(RatingStoreRequest $request)
    {
        $modelType = Relation::getMorphedModel($request->input('rateable.type'));

        /** @var Model|Rateable $entity */
        $entity = $modelType::findOrFail($request->input('rateable.id'));

        $rate = match ($request->input('rating.type')) {
            'upvote' => 1,
            'downvote' => -1,
        };

        try {
            $entity->ratings()->create(['user_id' => auth()->id(), 'rate' => $rate]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash', [
                'type' => 'danger', 'message' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('flash', [
            'type' => 'success', 'message' => 'Rating added successfully.'
        ]);
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
