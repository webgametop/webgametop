@php use App\Enums\GameProvider as GameProviderEnum; @endphp

@section('title', 'Игры &#8212; Витрина')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.showcase') }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Игры</div>
            <div class="text-secondary">Витрина</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <div class="row row-cards">
                @foreach($stats as $provider_name => $count)
                    @php($provider = GameProviderEnum::from($provider_name))
                    <div class="col-12 col-lg-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto d-none d-sm-block">
                                        <span class="bg-white text-white avatar avatar-2xl p-3">
                                            <img src="{{ $provider->logo() }}" alt="{{ $provider->label() }}">
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="h1">
                                            <div>{{ $count }} игр</div>
                                            <small class="text-muted">в каталоге</small>
                                        </div>
                                        <div class="font-weight-medium">{{ $provider->label() }}</div>
                                        <div class="text-secondary">
                                            <a href="{{ route('games', $provider) }}">Перейти</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                <x-oops/>
            </div>
        </div>
    </div>
</x-layouts::main>
