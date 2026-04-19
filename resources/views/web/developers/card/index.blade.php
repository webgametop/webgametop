@props(['developer', 'games', 'provider'])

@section('title', 'Разработчик')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.show', $provider, $developer) }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">Разработчики</div>
            <div class="text-muted">{{ $provider->label() }}</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
            <div class="d-flex">
                <div class="card me-3" title="0 плюсов / 0 минусов">
                    <div @class([
                        'card-body', 'd-flex', 'align-items-center', 'flex-column', 'p-0',
                        'justify-content-between' => Auth::check(),
                        'justify-content-center' => !Auth::check()
                    ]) style="width: 40px;">
                        @auth
                            <button type="button" class="btn btn-link p-0" title="Поставить плюсик" disabled="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-big-up m-0">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.586 3l-6.586 6.586a2 2 0 0 0 -.434 2.18l.068 .145a2 2 0 0 0 1.78 1.089h2.586v7a2 2 0 0 0 2 2h4l.15 -.005a2 2 0 0 0 1.85 -1.995l-.001 -7h2.587a2 2 0 0 0 1.414 -3.414l-6.586 -6.586a2 2 0 0 0 -2.828 0z"></path>
                                </svg>
                            </button>
                        @endauth
                        <div>0</div>
                        @auth
                            <button type="button" class="btn btn-link p-0" title="Поставить минус" disabled="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-big-down m-0">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z"></path>
                                </svg>
                            </button>
                        @endauth
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <div class="avatar" style="--tblr-avatar-size: 10rem; background-image: url('{{ asset('static/media/avatar/not-found.png') }}'); background-size: cover;"></div>
                    <div class="badge badge-outline text-default mt-3 p-2">0 подписчиков</div>
                </div>
                <div class="ms-3">
                    <h1 class="m-0">{{ $developer->name }}</h1>
                    <div class="text-muted">Анонимный разработчик</div>
                </div>
                @auth
                    <div class="ms-auto">
                        <a href="#" class="btn btn-warning mb-2 disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"></path>
                            </svg>
                            Добавить в избранное
                        </a>
                        <div class="btn-list ms-auto">
                            <a href="#" class="btn btn-primary flex-grow-1 justify-content-start disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 20l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.96 6.053"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                </svg>
                                Подписаться
                            </a>
                            <a href="#" class="dropdown btn btn-2 btn-icon" aria-label="Button" data-bs-toggle="dropdown" title="Ещё..." aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                    <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-none my-2">
                                <a href="#" class="dropdown-item disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-flag">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 5a1 1 0 0 1 .3 -.714a6 6 0 0 1 8.213 -.176l.351 .328a4 4 0 0 0 5.272 0l.249 -.227c.61 -.483 1.527 -.097 1.61 .676l.005 .113v9a1 1 0 0 1 -.3 .714a6 6 0 0 1 -8.213 .176l-.351 -.328a4 4 0 0 0 -5.136 -.114v6.552a1 1 0 0 1 -1.993 .117l-.007 -.117v-16z"></path>
                                    </svg>
                                    Пожаловаться
                                </a>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
            <div class="card mt-3">
                <div class="card-body">No bio yet.</div>
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
                            <a href="#tabs-games" class="nav-link disabled" data-bs-toggle="tab" role="tab">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon me-2 icon-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M15.5 4a6 6 0 0 1 5.945 5.187l1.532 7.883a3.3 3.3 0 0 1 -5.632 2.903l-3.776 -3.974l-3.14 .001l-3.719 3.916a3.3 3.3 0 0 1 -5.629 -2.92l1.634 -8.173a6 6 0 0 1 5.885 -4.823zm-7.5 3a1 1 0 0 0 -1 1v1h-1a1 1 0 1 0 0 2h1v1a1 1 0 0 0 2 0v-1h1a1 1 0 0 0 0 -2h-1v-1a1 1 0 0 0 -1 -1m10 2h-4a1 1 0 0 0 0 2h4a1 1 0 0 0 0 -2"/>
                                </svg>
                                Игры
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
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
                                <div><code>@todo</code></div>
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
                                <h3>Похожие разработчики</h3>
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
                        <div class="tab-pane" id="tabs-comments" role="tabpanel">
                            <code>@todo comments</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::main>
