@props(['games', 'provider'])

@section('title', 'Игры &#8212; ' . $provider->label())

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games', $provider) }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Игры</div>
            <div class="text-secondary">{{ $provider->label() }}</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <x-cards-game :games="$games"/>
        </div>
    </div>
</x-layouts::main>
