@props(['user'])

@section('title', "Профиль $user->nickname")

<x-layouts::main>
    <div class="page-header m-0">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <span class="avatar avatar-2xl bg-azure-lt" style="background-image: url('{{ $user->gravatar(2048) }}')"></span>
                    <br>
                    @auth
                        @if($user->equals(request()->user()))
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 mt-2" data-loading-text="Выход...">
                                    <i class="fas fa-sign-out-alt" style="font-size: 16px;"></i>
                                    <span class="ms-1">Выйти</span>
                                </button>
                            </form>
                        @endif
                    @endauth
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
                            15/10/1972
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
                        @endif
                    @endauth
                    <div class="btn-list">
                        <a href="#" class="btn btn-2 btn-icon" aria-label="Button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-2 btn-icon" aria-label="Button" title="Начать диалог">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                <path d="M8 9h8"></path>
                                <path d="M8 13h6"></path>
                                <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-primary btn-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                            Following
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-none">
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-profile ">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="{{ $user->gravatar(2048) }}" alt="" class="bg-info rounded-5">
                                @auth
                                @if($user->equals(request()->user()))
                                <form action="{{ route('logout') }}" method="post" class="mt-4">
                                    @csrf
                                    <button type="submit" class="btn btn-light text-start rounded-5 w-100" data-loading-text="Выход...">
                                        <i class="fas fa-sign-out-alt" style="font-size: 16px;"></i>
                                        <span class="ms-1">Выйти</span>
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </div>
                            <div class="col-lg-6 align-self-start">
                                <div class="main-info header-text">
                                    <span @class(['text-bg-success' => $user->isOnline()])>{{ $user->isOnline() ? 'Online' : 'Offline' }}</span>
                                    <h4>{{ $user->nickname }} <small class="text-muted">{{ '@' . $user->username }}</small></h4>
                                    <p>Any details such as age, occupation or city. Example: 23 y.o. designer from San Francisco</p>
                                    <div class="main-border-button">
                                        {{-- buttons --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 align-self-start">
                                @auth
                                @if($user->equals(request()->user()))
                                <div class="main-border-button mb-4">
                                    <a
                                        href="{{ route('users.edit.account', [$user, $user->username]) }}"
                                        class="w-100" style="text-transform: unset;"
                                    >Редактировать профиль</a>
                                </div>
                                @endif
                                @endauth
{{--                                <ul class="mb-4">--}}
{{--                                    <li data-badges>Значки <span><a href="">0</a></span></li>--}}
{{--                                    <li data-achievements>Достижения <span><a href="">0</a></span></li>--}}
{{--                                </ul>--}}
                                <ul class="mb-4">
                                    <li data-games>Игры <span><a href="">0</a></span></li>
{{--                                    <li data-reviews>Обзоры <span><a href="">1</a></span></li>--}}
{{--                                    <li data-feedbacks>Отзывы <span><a href="">16</a></span></li>--}}
{{--                                    <li data-comments>Комментарии <span><a href="">3</a></span></li>--}}
                                </ul>
{{--                                <ul class="mb-4">--}}
{{--                                    <li data-friends>Друзья <span><a href="">32</a></span></li>--}}
{{--                                </ul>--}}
                            </div>
                        </div>
                        {{-- contect --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('body-script')
    @endpush
</x-layouts::main>
