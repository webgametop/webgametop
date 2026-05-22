@props(['game', 'developer', 'provider'])

@section('title', 'Игра')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.show', $provider, $game) }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Игры</div>
            <div class="text-muted">{{ $provider->label() }}</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3">
                            <div class="carousel-item active">
                                <img class="d-block w-100" alt="" src="{{ asset('static/media/not-found.png') }}">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-5 d-flex flex-column mt-4 mt-lg-0">
                    <div class="mb-3">
                        <h1 class="m-0">{{ $game->title }}</h1>
                        <div>Разработчик <a href="{{ route('developers.show', [$developer, $developer->slug]) }}" class="link-secondary">{{ $developer->name }}</a></div>
                        <hr class="my-3">
                        <div>Дата выхода <span class="text-muted">{{ $game->released_at->format('d.m.Y') }}</span></div>
                    </div>
                    <div class="mt-auto">
                        <div class="d-flex">
                            <a href="#" class="btn btn-primary p-3 w-100 disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-player-play m-0">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M6 4v16a1 1 0 0 0 1.524 .852l13 -8a1 1 0 0 0 0 -1.704l-13 -8a1 1 0 0 0 -1.524 .852z"/>
                                </svg>
                            </a>
                            @auth
                                <a href="{{ route('games.votes', [$game, $game->slug]) }}" class="btn btn-danger ms-3" style="padding: 16px 18px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-thumb-up m-0">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z"/>
                                        <path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z"/>
                                    </svg>
                                </a>
                            @endauth
                        </div>
                        <div class="d-flex align-items-center mt-3" style="height: 55px;">
                            @auth
                                @php($is_favorite = $game->is_favorite)
                                <form action="{{ route('favorites.toggle') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="favoriteable[type]" value="{{ morph_alias($game::class) }}" autocomplete="off">
                                    <input type="hidden" name="favoriteable[id]" value="{{ $game->id }}" autocomplete="off">
                                    <button
                                        type="submit"
                                        @class(['btn', 'me-3', $is_favorite ? 'btn-warning' : 'btn-outline-warning'])
                                        style="padding: 15px;"
                                        title="Добавить в избранное"
                                        data-loading-text
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star m-0">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"/>
                                        </svg>
                                    </button>
                                </form>
                            @endauth
                            @php($is_rating = $game->is_rating)
                            <div class="card h-100 w-100" title="{{ $game->ratings()->where('rate', 1)->count() }} плюсов / {{ $game->ratings()->where('rate', -1)->count() }} минусов">
                                @php($is_auth = auth()->check())
                                @php($rate = $game->ratings()->sum('rate'))
                                @auth
                                    @if($is_rating)
                                        <div class="card-body text-center">{{ $rate }}</div>
                                    @else
                                        <form action="{{ route('ratings.store') }}" method="post" @class([
                                            'card-body', 'd-flex', 'align-items-center', 'p-0',
                                            'justify-content-between' => $is_auth,
                                            'justify-content-center' => !$is_auth,
                                        ])>
                                            @csrf
                                            <input type="hidden" name="rateable[type]" value="{{ morph_alias($game::class) }}" autocomplete="off">
                                            <input type="hidden" name="rateable[id]" value="{{ $game->id }}" autocomplete="off">
                                            <button type="submit" class="btn btn-link p-0 ms-1" name="rate" value="upvote" title="Поставить плюсик">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-big-up m-0">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10.586 3l-6.586 6.586a2 2 0 0 0 -.434 2.18l.068 .145a2 2 0 0 0 1.78 1.089h2.586v7a2 2 0 0 0 2 2h4l.15 -.005a2 2 0 0 0 1.85 -1.995l-.001 -7h2.587a2 2 0 0 0 1.414 -3.414l-6.586 -6.586a2 2 0 0 0 -2.828 0z"/>
                                                </svg>
                                            </button>
                                            <div>{{ $rate }}</div>
                                            <button type="submit" class="btn btn-link p-0 me-1" name="rate" value="downvote" title="Поставить минус">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-big-down m-0">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <div class="card-body text-center">{{ $rate }}</div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-games-nav :game="$game">
                <x-ui.subheadline label="Описание">
                    <x-ui.card>
                        {{ $game->description }}
                    </x-ui.card>
                </x-ui.subheadline>
                <div class="row row-cards">
                    <div class="col-md-4">
                        <x-ui.subheadline label="Страницу посетили">
                            <x-ui.card>
                                {{ $game->views()->count() }} раза
                            </x-ui.card>
                        </x-ui.subheadline>
                    </div>
                    <div class="col-md-4">
                        <x-ui.subheadline label="Добавили в избранное">
                            <x-ui.card>
                                {{ $game->favorites->count() }} пользователя
                            </x-ui.card>
                        </x-ui.subheadline>
                    </div>
                    <div class="col-md-4">
                        <x-ui.subheadline label="Голосов за всё время">
                            <x-ui.card>
                                {{ $game->votes()->count() }} голоса
                            </x-ui.card>
                        </x-ui.subheadline>
                    </div>
                </div>
                <x-ui.subheadline label="Похожие игры">
                    <x-oops/>
                </x-ui.subheadline>
            </x-games-nav>
        </div>
    </div>
    <x-views-record :viewable="$game"/>
</x-layouts::main>
