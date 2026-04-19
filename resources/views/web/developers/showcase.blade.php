@php use App\Enums\GameProvider as GameProviderEnum; @endphp

@section('title', 'Разработчики &#8212; Витрина')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.showcase') }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Разработчики</div>
            <div class="text-secondary">Витрина</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="row row-cards">
                        @foreach($stats as $provider_name => $count)
                            @php($provider = GameProviderEnum::from($provider_name))
                            <div class="col-12">
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
                                                    <div>{{ $count }} разработчиков</div>
                                                    <small class="text-muted">в каталоге</small>
                                                </div>
                                                <div class="font-weight-medium">{{ $provider->label() }}</div>
                                                <div class="text-secondary">
                                                    <a href="{{ route('developers', $provider) }}">Перейти</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card card-md h-100 mt-4 m-lg-0">
                        <div class="card-body text-center"><code>component::booster::developer</code></div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <x-oops/>
            </div>
        </div>
    </div>
</x-layouts::main>
