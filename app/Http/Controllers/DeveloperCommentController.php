<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Comment;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DeveloperCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Developer $developer)
    {
        /** @var GameProviderEnum $provider */
        $provider = $developer->provider;
        /** @var Collection<Comment> $comments */
        $comments = $developer
            ->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(13); // @todo

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
    public function store(Request $request, Developer $developer)
    {
        $developer->comments()->save(Comment::make([
            'user_id' => auth()->id(),
            'body' => $request->input('comment.body'),
        ]));

        return redirect()->route('developers.comments', [$developer, $developer->slug])->with('flash', [
            'type' => 'success', 'message' => 'Комментарий успешно добавлен.'
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
