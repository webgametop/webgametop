@props(['game', 'provider', 'process'])

@section('title', 'Игра')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('games.votes', $provider, $game) }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Игры</div>
            <div class="text-muted">{{ $provider->label() }}</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <div class="row row-cards">
                @if($process['allowed'])
                    <div class="col">
                        <div class="card card-md">
                            <div class="card-body text-center">
                                <div class="text-uppercase text-secondary font-weight-medium">Сайт</div>
                                <div class="display-5 fw-bold my-3">+1 голос</div>
                                <ul class="list-unstyled lh-lg text-start">
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1 text-danger icon-2">
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                        Бонус в игре
                                    </li>
                                </ul>
                                <div class="text-center mt-4">
                                    <form action="{{ route('games.votes', [$game, $game->slug]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn w-100" data-loading-text="Голосование...">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-thumb-up">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z"></path>
                                                <path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z"></path>
                                            </svg>
                                            Голосовать
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-md">
                            <div class="ribbon ribbon-top bg-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-3">
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </div>
                            <div class="card-body text-center">
                                <div class="text-uppercase text-secondary font-weight-medium">
                                    {{ $provider->label() }}
                                </div>
                                <div class="display-5 fw-bold my-3">+1 голос</div>
                                <ul class="list-unstyled lh-lg text-start">
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1 text-success icon-2">
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        Бонус в игре
                                    </li>
                                </ul>
                                <div class="text-center mt-4">
                                    <a href="https://yandex.ru/games/app/{{ $game->identity }}?payload={{ $game->payload() }}" class="btn btn-danger w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-external-link">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5a1 1 0 0 1 0 2h-6a1 1 0 0 0 -1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1 -1v-6a1 1 0 0 1 2 0v6a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3zm3 -2h5l.075 .003l.126 .017l.111 .03l.111 .044l.098 .052l.096 .067l.09 .08q .054 .053 .097 .112l.071 .11l.054 .114l.035 .105l.03 .148l.006 .118v5a1 1 0 0 1 -2 0v-2.586l-7.293 7.293a1 1 0 0 1 -1.414 -1.414l7.291 -7.293h-2.584a1 1 0 0 1 0 -2"/>
                                        </svg>
                                        Перейти
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-8">
                        <div class="card card-md h-100">
                            <div class="card-body text-center">
                                <div class="h1">Спасибо за участие! Сегодня вы уже голосовали.</div>
                                <div class="text-muted">Отдохните, подумайте, а завтра возвращайтесь с новыми силами.</div>
                                <hr>
                                <div class="display-4"><b id="usage">{{ $process['next_in'] }}</b></div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col">
                    <div class="card card-md">
                        <div class="card-body text-center">
                            <div class="text-uppercase text-secondary font-weight-medium">СМС</div>
                            <div class="display-5 fw-bold my-3">+1 голос</div>
                            <ul class="list-unstyled lh-lg text-start">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1 text-danger icon-2">
                                        <path d="M18 6l-12 12"></path>
                                        <path d="M6 6l12 12"></path>
                                    </svg>
                                    Бонус в игре
                                </li>
                            </ul>
                            <div class="text-center mt-4">
                                <button type="button" class="btn w-100" data-loading-text="Голосование..." disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-thumb-up">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z"></path>
                                        <path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z"></path>
                                    </svg>
                                    Голосовать
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-info alert-dismissible mt-4 mb-0" role="alert">
                <div class="alert-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="alert-heading"><strong>Ой! Похоже, здесь есть подводные камни.</strong></h4>
                    <div class="alert-description">Бонусы являются частью игровой механики и предоставляются исключительно разработчиком. Наш сайт выступает только в роли инструмента для голосования и навигации. Все вопросы по бонусам следует адресовать разработчику игры.</div>
                </div>
            </div>
        </div>
    </div>
    @push('body-script')
        <script type="module">
            const countdown = new easytimer({ countdown: true} );

            const target_timestamp = {{ $process['next_at'] }};
            const target_ms = target_timestamp * 1000;
            const remaining_ms = target_ms - Date.now();

            countdown.start({ startValues: { seconds: remaining_ms / 1000 } });

            countdown.addEventListener('secondsUpdated', function (e) {
                $('#usage').html(countdown.getTimeValues().toString());
            });
        </script>
    @endpush
</x-layouts::main>
