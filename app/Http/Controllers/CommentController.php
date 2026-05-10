<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Contracts\Commentable;
use App\Models\User;
use App\Services\CommentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $service,
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
    public function store(CommentStoreRequest $request)
    {
        $dto = $request->toDto();

        $modelType = Relation::getMorphedModel($dto->getCommentableType());

        /** @var Commentable|Model $entity */
        $entity = $modelType::findOrFail($dto->getCommentableId());

        $comment = Comment::make($dto->toArray());

        try {
            $this->service->createComment($entity, $comment);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash', [
                'type' => 'danger', 'message' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('flash', [
            'type' => 'success', 'message' => 'The comment has been successfully added.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        /** @var User $user */
        $user = $comment->user;

        /** @var Commentable|Model $commentable */
        $entity = $comment->commentable;

        $answers = $comment->answers()->with('user')->orderBy('created_at', 'desc')->paginate(13);

        return view('web.comments.show', compact('entity', 'comment', 'answers', 'user'));
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
