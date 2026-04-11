@props(['game', 'developer', 'provider'])

@section('title', 'Игра')

<x-layouts::main>
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">{{ $game->title }} ({{ $game->created_at->format('Y') }})</h1>
            Разработчик <a href="{{ route('developers.show', [$developer, $developer->slug]) }}" class="link-secondary">{{ $developer->name }}</a>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <code>@todo</code>
        </div>
    </div>
</x-layouts::main>
