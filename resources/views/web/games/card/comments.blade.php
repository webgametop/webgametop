@props(['game', 'provider'])

@section('title', 'Комментарии')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.comments', $provider, $game) }}
    </div>
    <div class="container">
        <x-games-nav :game="$game">
            <x-comments-chat :commentable="$game" :comments="$comments"/>
        </x-games-nav>
    </div>
</x-layouts::main>
