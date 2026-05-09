@props(['game', 'provider'])

@section('title', 'Комментарии')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.comments', $provider, $game) }}
    </div>
    <div class="container">
        <x-games-card :game="$game">
            <x-comments-card :commentable="$game" :comments="$comments"/>
        </x-games-card>
    </div>
</x-layouts::main>
