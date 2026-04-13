@props(['game', 'developer', 'provider'])

@section('title', 'Игра')

<x-layouts::main>
    <div class="page-header">
        <div class="container">
            <div class="page-title">Игры</div>
            <div class="text-muted">{{ $provider->label() }}</div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3">
                            <div class="carousel-item active">
                                <img class="d-block w-100" alt="" src="https://www.tidelandemc.com/assets/camaleon_cms/image-not-found-91d1f1515c0b9b458a51a3c83506dc4bcc138ec059ad787d2bea936d9e29da74.png">
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
                    <div>
                        <h1 class="m-0">{{ $game->title }} ({{ $game->released_at->format('Y') }})</h1>
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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger ms-3" style="padding: 16px 18px;" title="Голосовать" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-thumb-up m-0">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z"/>
                                        <path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z"/>
                                    </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row row-cards">
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
                                                                    <a href="#" class="btn w-100">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-thumb-up">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M13 3a3 3 0 0 1 2.995 2.824l.005 .176v4h2a3 3 0 0 1 2.98 2.65l.015 .174l.005 .176l-.02 .196l-1.006 5.032c-.381 1.626 -1.502 2.796 -2.81 2.78l-.164 -.008h-8a1 1 0 0 1 -.993 -.883l-.007 -.117l.001 -9.536a1 1 0 0 1 .5 -.865a2.998 2.998 0 0 0 1.492 -2.397l.007 -.202v-1a3 3 0 0 1 3 -3z"></path>
                                                                            <path d="M5 10a1 1 0 0 1 .993 .883l.007 .117v9a1 1 0 0 1 -.883 .993l-.117 .007h-1a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-7a2 2 0 0 1 1.85 -1.995l.15 -.005h1z"></path>
                                                                        </svg>
                                                                        Голосовать
                                                                    </a>
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
                                                                    <a href="https://yandex.ru/games/app/{{ $game->identity }}?payload={{ $game->votePayload() }}" class="btn btn-danger w-100">
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
                                    </div>
                                </div>
                            @endauth
                        </div>
                        <div class="d-flex mt-3" style="height: 54px;">
                            @auth
                                <button type="button" class="btn btn-outline-warning p-3 me-3" title="Добавить в избранное" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star m-0">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"/>
                                    </svg>
                                </button>
                            @endauth
                            <div class="card w-100" title="0 плюсов / 0 минусов">
                                <div @class([
                                        'card-body', 'd-flex', 'align-items-center', 'p-0',
                                        'justify-content-between' => Auth::check(),
                                        'justify-content-center' => !Auth::check()
                                    ])>
                                    @auth
                                        <button type="button" class="btn btn-link p-0 ms-1" title="Поставить плюсик" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-big-up m-0">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M10.586 3l-6.586 6.586a2 2 0 0 0 -.434 2.18l.068 .145a2 2 0 0 0 1.78 1.089h2.586v7a2 2 0 0 0 2 2h4l.15 -.005a2 2 0 0 0 1.85 -1.995l-.001 -7h2.587a2 2 0 0 0 1.414 -3.414l-6.586 -6.586a2 2 0 0 0 -2.828 0z"/>
                                            </svg>
                                        </button>
                                    @endauth
                                    <div>0</div>
                                    @auth
                                        <button type="button" class="btn btn-link p-0 me-1" title="Поставить минус" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-big-down m-0">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z"/>
                                            </svg>
                                        </button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs pt-3 px-3" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-index" class="nav-link active" data-bs-toggle="tab" role="tab">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-2">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                </svg>
                                Главная
                            </a>
                        </li>
                        <li class="nav-item ms-auto" role="presentation">
                            <a href="#tabs-reviews" class="nav-link disabled" data-bs-toggle="tab" role="tab">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon me-2 icon-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 2c5.498 0 10 4.002 10 9c0 1.351 -.6 2.64 -1.654 3.576c-1.03 .914 -2.412 1.424 -3.846 1.424h-2.516a1 1 0 0 0 -.5 1.875a1 1 0 0 1 .194 .14a2.3 2.3 0 0 1 -1.597 3.99l-.156 -.009l.068 .004l-.273 -.004c-5.3 -.146 -9.57 -4.416 -9.716 -9.716l-.004 -.28c0 -5.523 4.477 -10 10 -10m-3.5 6.5a2 2 0 0 0 -1.995 1.85l-.005 .15a2 2 0 1 0 2 -2m8 0a2 2 0 0 0 -1.995 1.85l-.005 .15a2 2 0 1 0 2 -2m-4 -3a2 2 0 0 0 -1.995 1.85l-.005 .15a2 2 0 1 0 2 -2"/>
                                </svg>
                                Обзоры
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-comments" class="nav-link disabled" data-bs-toggle="tab" role="tab">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon me-2 icon-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M20.901 14.995l-.044 -.006a.4 .4 0 0 1 -.102 -.02l-.045 -.012l-.048 -.017l-.045 -.016l-.043 -.02l-.045 -.022l-.04 -.024l-.044 -.026l-.043 -.032l-.036 -.027a1 1 0 0 1 -.073 -.066l-2.707 -2.707h-6.586a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h9a2 2 0 0 1 2 2v10a1 1 0 0 1 -.076 .383l-.02 .043l-.022 .045l-.024 .04l-.026 .044l-.032 .043l-.027 .036a1 1 0 0 1 -.578 .347l-.052 .008l-.044 .006a1 1 0 0 1 -.198 0"/>
                                    <path d="M7 8.999v1.001a4 4 0 0 0 4 4h4v3a2 2 0 0 1 -2 2h-6.586l-2.707 2.707c-.63 .63 -1.707 .184 -1.707 -.707v-10a2 2 0 0 1 2 -2z"/>
                                </svg>
                                Комментарии
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-index" role="tabpanel">
                            <div>
                                <h2>Описание</h2>
                                <div>{{ $game->description }}</div>
                            </div>
                            <div class="row row-cards mt-2">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Страницу посетили</div>
                                            <div class="h3 m-0">0 раз</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Добавили в избранное</div>
                                            <div class="h3 m-0">0 пользователей</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Голосов за всё время</div>
                                            <div class="h3 m-0">0 голосов</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Голосов в этом месяце</div>
                                            <div class="h3 m-0">0 голосов</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h3>Похожие игры</h3>
                                <div class="alert alert-info alert-dismissible" role="alert">
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
                        <div class="tab-pane" id="tabs-reviews" role="tabpanel">
                            <code>@todo reviews</code>
                        </div>
                        <div class="tab-pane" id="tabs-comments" role="tabpanel">
                            <code>@todo comments</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::main>
