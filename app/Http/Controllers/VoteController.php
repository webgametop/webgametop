<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\VoteCreatedVia as CreatedViaEnum;
use App\Enums\VoteType as Strategy;
use App\Http\Requests\VoteStoreRequest;
use App\Models\Contracts\Votable;
use App\Models\User;
use App\Services\VoteService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct(
        private readonly VoteService $service,
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
    public function store(VoteStoreRequest $request)
    {
        $modelType = Relation::getMorphedModel($request->input('votable.type'));

        /** @var Model|Votable $entity */
        $entity = $modelType::findOrFail($request->input('votable.id'));

        /** @var User $user */
        $user = auth()->user();

        $this->service->setStrategy(Strategy::DAILY);

        try {
            $this->service->registerVote($entity, $user, CreatedViaEnum::WEB);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash', [
                'type' => 'info',
                'message' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => 'Thank you! Your vote has been counted. Come back tomorrow to vote again.'
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
