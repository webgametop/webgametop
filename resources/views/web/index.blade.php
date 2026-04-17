@section('title', 'Главная')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('home') }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Пользователи</div>
            <div class="text-secondary">В данном разделе представлены все пользователи сайта, отсортированные по дате последнего посещения.</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            content
        </div>
    </div>
</x-layouts::main>
