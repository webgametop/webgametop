@props(['developer', 'provider'])

@section('title', 'Комментарии')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.comments', $provider, $developer) }}
    </div>
    <div class="container">
        <x-developers-card :developer="$developer">
            <x-comments-card :commentable="$developer" :comments="$comments"/>
        </x-developers-card>
    </div>
</x-layouts::main>
