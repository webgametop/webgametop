@props(['game', 'provider'])

@section('title', 'Обзоры')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.reviews', $provider, $game) }}
    </div>
    <div class="container">
        <x-games-card :game="$game">
            <x-oops/>
        </x-games-card>
    </div>
</x-layouts::main>
