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
            <div class="alert alert-info alert-dismissible mt-4" role="alert">
                <div class="alert-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="alert-heading"><strong>Ой! Похоже, здесь ничего нет.</strong></h4>
                    <div class="alert-description">Раздел в разработке. Скоро здесь появится что-то интересное!</div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::main>
