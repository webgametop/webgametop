@props(['developer', 'provider'])

@section('title', 'Комментарии')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.comments', $provider, $developer) }}
    </div>
    <div class="container">
        <x-developers-nav :developer="$developer">
            <x-comments-chat :commentable="$developer" :comments="$comments"/>
        </x-developers-nav>
    </div>
</x-layouts::main>
