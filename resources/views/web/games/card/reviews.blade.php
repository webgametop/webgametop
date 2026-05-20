@props(['game', 'provider'])

@section('title', 'Обзоры')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.reviews', $provider, $game) }}
    </div>
    <div class="container">
        <x-games-nav :game="$game">
            <x-oops/>
        </x-games-nav>
    </div>
</x-layouts::main>
