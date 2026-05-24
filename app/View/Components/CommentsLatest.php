<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Comment;
use App\Models\Developer;
use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentsLatest extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $q = Comment::query();

        $comments = $q
            ->with('user')
            ->with('commentable')
            ->whereHasMorph('commentable', [Developer::class, Game::class])
            ->orderBy('created_at', 'desc')
            ->limit(13)
            ->get();

        return view('components.comments-latest', compact('comments'));
    }
}
