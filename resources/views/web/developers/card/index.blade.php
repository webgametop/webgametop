@props(['developer', 'games', 'provider'])

@section('title', 'Разработчик')

<x-layouts::main>
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">{{ $developer->name }}</h1>
            <span class="text-muted">{{ $provider->label() }}</span>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <code>@todo</code>
        </div>
    </div>
</x-layouts::main>
