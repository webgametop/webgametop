@props(['developer', 'provider'])

@section('title', 'Игры')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.games', $provider, $developer) }}
    </div>
    <div class="container">
        <x-developers-card :developer="$developer">
            <x-oops/>
        </x-developers-card>
    </div>
</x-layouts::main>
