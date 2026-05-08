<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\GameProvider as GameProviderEnum;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Developer;
use App\Services\CommentService;
use Illuminate\Http\Request;

class DeveloperCommentController extends Controller
{
    public function __construct(
        private readonly CommentService $commentService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Developer $developer)
    {
        /** @var GameProviderEnum $provider */
        $provider = $developer->provider;

        $comments = $developer->comments()->with('user')->orderBy('created_at', 'desc')->paginate(13);

        return view('web.developers.card.comments', compact('developer', 'provider', 'comments'));
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
    public function store(CommentStoreRequest $request, Developer $developer)
    {
        $route_data = [$developer, $developer->slug];

        $comment = Comment::make([
            'user_id' => auth()->id(),
            'body' => $request->input('comment.body'),
        ]);

        try {
            $this->commentService->createComment($developer, $comment);
        } catch (\Exception $e) {
            return redirect()->route('developers.comments', $route_data)->with('flash', [
                'type' => 'danger', 'message' => $e->getMessage()
            ]);
        }

        return redirect()->route('developers.comments', $route_data)->with('flash', [
            'type' => 'success', 'message' => 'Comment added successfully.'
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
