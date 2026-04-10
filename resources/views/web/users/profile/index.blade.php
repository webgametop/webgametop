@props(['user'])

@section('title', "Профиль $user->nickname")

<x-layouts::main>
    <div class="page-body">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <span class="avatar avatar-2xl bg-azure-lt" style="background-image: url('{{ $user->gravatar(2048) }}')"></span>
                </div>
                <div class="col">
                    <h1 class="fw-bold m-0">{{ $user->nickname }}</h1>
                    <h2 class="text-muted">{{ '@' . $user->username }}</h2>
                    <div class="my-2">Any details such as age, occupation or city. Example: 23 y.o. designer from San Francisco</div>
                    <div class="list-inline list-inline-dots text-secondary">
                        <div class="list-inline-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-inline icon-2">
                                <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13"></path>
                                <path d="M9 4v13"></path>
                                <path d="M15 7v13"></path>
                            </svg>
                            СПб
                        </div>
                        <div class="list-inline-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-inline icon-2">
                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                <path d="M3 7l9 6l9 -6"></path>
                            </svg>
                            <a href="#" class="text-reset">test@example.com</a>
                        </div>
                        <div class="list-inline-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-inline icon-2">
                                <path d="M3 20h18v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8z"></path>
                                <path d="M3 14.803c.312 .135 .654 .204 1 .197a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1c.35 .007 .692 -.062 1 -.197"></path>
                                <path d="M12 4l1.465 1.638a2 2 0 1 1 -3.015 .099l1.55 -1.737z"></path>
                            </svg>
                            01/01/1970
                        </div>
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    @auth
                        @if($user->equals(request()->user()))
                            <a href="{{ route('users.edit.account', [$user, $user->username]) }}" class="btn btn-primary mb-2 w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-cog">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"/>
                                    <path d="M13.5 6.5l4 4"/>
                                    <path d="M17.001 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                    <path d="M19.001 15.5v1.5"/>
                                    <path d="M19.001 21v1.5"/>
                                    <path d="M22.032 17.25l-1.299 .75"/>
                                    <path d="M17.27 20l-1.3 .75"/>
                                    <path d="M15.97 17.25l1.3 .75"/>
                                    <path d="M20.733 20l1.3 .75"/>
                                </svg>
                                Редактировать профиль
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 mb-2" data-loading-text="Выход...">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"/>
                                        <path d="M9 12h12l-3 -3"/>
                                        <path d="M18 15l3 -3"/>
                                    </svg>
                                    Выйти
                                </button>
                            </form>
                        @else
                            <a href="#" class="btn btn-primary mb-2 w-100 disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                    <path d="M16 19h6"/>
                                    <path d="M19 16v6"/>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"/>
                                </svg>
                                Добавить в друзья
                            </a>
{{--                            <a href="#" class="btn btn-primary mb-2 w-100 disabled">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-message">--}}
{{--                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>--}}
{{--                                    <path d="M18 3a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-4.724l-4.762 2.857a1 1 0 0 1 -1.508 -.743l-.006 -.114v-2h-1a4 4 0 0 1 -3.995 -3.8l-.005 -.2v-8a4 4 0 0 1 4 -4zm-4 9h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m2 -4h-8a1 1 0 1 0 0 2h8a1 1 0 0 0 0 -2"/>--}}
{{--                                </svg>--}}
{{--                                Написать--}}
{{--                            </a>--}}
                        @endif
                    @endauth
                    <div class="btn-list">
                        @auth
                            @if(! $user->equals(request()->user()))
                                <a href="#" class="btn btn-primary btn-3 disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 20l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.96 6.053"/>
                                        <path d="M16 19h6"/>
                                        <path d="M19 16v6"/>
                                    </svg>
                                    Подписаться
                                </a>
                                <a href="#" class="dropdown btn btn-2 btn-icon ms-auto" aria-label="Button" data-bs-toggle="dropdown" title="Ещё...">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                        <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-none my-2">
                                    <a href="#" class="dropdown-item disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cancel">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                            <path d="M18.364 5.636l-12.728 12.728"/>
                                        </svg>
                                        Заблокировать
                                    </a>
                                    <a href="#" class="dropdown-item disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-flag">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 5a1 1 0 0 1 .3 -.714a6 6 0 0 1 8.213 -.176l.351 .328a4 4 0 0 0 5.272 0l.249 -.227c.61 -.483 1.527 -.097 1.61 .676l.005 .113v9a1 1 0 0 1 -.3 .714a6 6 0 0 1 -8.213 .176l-.351 -.328a4 4 0 0 0 -5.136 -.114v6.552a1 1 0 0 1 -1.993 .117l-.007 -.117v-16z"/>
                                        </svg>
                                        Пожаловаться
                                    </a>
                                    <a href="#" class="dropdown-item disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-minus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.348 0 .686 .045 1.009 .128"/>
                                            <path d="M16 19h6"/>
                                        </svg>
                                        Удалить из друзей
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Комментарии</h3>
                        </div>
                        <div class="card-body">
                            <code>@todo</code>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" data-badges>Значки <span><a href="#">0</a></span></li>
                            <li class="list-group-item" data-achievements>Достижения <span><a href="#">0</a></span></li>
                        </ul>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" data-reviews>Обзоры <span><a href="#">0</a></span></li>
                            <li class="list-group-item" data-comments>Комментарии <span><a href="#">0</a></span></li>
                        </ul>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" data-friends>Друзья <span><a href="#">0</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('body-script')
    @endpush
</x-layouts::main>
