@props(['comment', 'user', 'answers', 'commentable'])

@section('title', 'Комментарий от ' . $user->nickname)

<x-layouts::main>
    <div class="page-body">
        <div class="container">
            <x-ui.subheadline label="Комментарий {{ '#' . $comment->id }} от <a href={{ route('users.show', [$user, $user->username]) }}>{{ $user->nickname }}</a>">
                <b>в топике</b>
                <a href="{{ route($commentable->getTable() . '.comments', [$commentable, $commentable->slug]) }}">
                    <b>{{ $commentable->title ?? $commentable->name }}</b>
                </a>
                <span class="text-muted">{{ $comment->created_at->ago() }}</span>
                <p>{{ $comment->body }}</p>
            </x-ui.subheadline>
            <x-comments-card :commentable="$commentable" :comments="$answers" label="Ответы"/>
        </div>
    </div>
    <x-views-record :viewable="$comment"/>
</x-layouts::main>
