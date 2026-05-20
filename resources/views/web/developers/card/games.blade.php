@props(['developer', 'games', 'provider'])

@section('title', 'Игры')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.games', $provider, $developer) }}
    </div>
    <div class="container">
        <x-developers-nav :developer="$developer">
            <x-cards-game :games="$games"/>
        </x-developers-nav>
    </div>
</x-layouts::main>
