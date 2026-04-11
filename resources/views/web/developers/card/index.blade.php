@props(['developer', 'games', 'provider'])

@section('title', 'Разработчик')

<x-layouts::main>
    <div class="page-header">
        <div class="container">
            <div class="page-title">{{ $developer->name }}</div>
            <div class="text-muted">{{ $provider->label() }}</div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <code>@todo</code>
        </div>
    </div>
</x-layouts::main>
