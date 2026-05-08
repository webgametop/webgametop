<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function store(Request $request, Comment $comment)
    {
        $target = $comment->commentable;

        $target->comments()->save(Comment::make([
            'user_id' => auth()->id(),
            'parent_id' => $comment->id,
            'body' => $request->input('comment.body'),
        ]));

        return redirect()->route('comments.show', $comment)->with('flash', [
            'type' => 'success', 'message' => 'Ответ успешно добавлен.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        /** @var User $user */
        $user = $comment->user;
        /** @var Model $commentable */
        $commentable = $comment->commentable;

        $answers = $comment
            ->answers()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(13);

        return view('web.comments.show', compact('comment', 'user', 'answers', 'commentable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
