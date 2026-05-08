@props(['comment', 'user', 'answers'])

@section('title', 'Комментарий от ' . $user->nickname)

<x-layouts::main>
    <div class="page-body">
        <div class="container">
            <x-ui.subheadline label="Комментарий {{ '#' . $comment->id }} от <a href={{ route('users.show', [$user, $user->username]) }}>{{ $user->nickname }}</a>">
                <div>{{ $comment->body }}</div>
            </x-ui.subheadline>
            <x-comments-card action="{{ route('comments.store', $comment) }}" label="Ответы" :comments="$answers"/>
        </div>
    </div>
</x-layouts::main>
