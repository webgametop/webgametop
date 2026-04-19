@php use App\Enums\GameProvider as GameProviderEnum; @endphp
<header class="navbar navbar-expand-md py-2 d-print-none">
    <div class="container">
        {{-- BEGIN NAVBAR TOGGLER --}}
        <button
            class="navbar-toggler"
            style="font-size: 16px;"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
            aria-controls="navbar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- END NAVBAR TOGGLER --}}
        {{-- BEGIN NAVBAR LOGO --}}
        <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/" class="h1 m-0 text-decoration-none text-uppercase" title="Главная">
                {{ config('app.name') }}
            </a>
        </div>
        {{-- TELEGRAM --}}
        <div class="d-none d-lg-block pe-3">
            <a
                href="https://t.me/webgametop"
                class="btn p-0"
                target="_blank"
                rel="noreferrer"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                aria-label="Канал в Telegram"
                data-bs-original-title="Канал в Telegram"
            >
                <img
                    style="margin: 5px;"
                    src="{{ asset('static/media/brands/telegram.svg') }}"
                    width="26"
                    alt="Telegram"
                >
            </a>
        </div>
        {{-- END NAVBAR LOGO --}}
        <div class="navbar-nav flex-row order-md-last align-items-center">
            @guest
                <a
                    href="{{ route('login') }}"
                    @class([
                        'btn', 'rounded', 'text-uppercase',
                        'active' => request()->routeIs(['login', 'register'])
                    ])
                >
                    <i class="fas fa-sign-in-alt me-2" style="font-size: 20px;"></i>
                    Вход | Регистрация
                </a>
            @else
                @php($user = auth()->user())
                <div class="nav-item me-3">
                    <div class="btn-list">
                        @foreach([
                            ['label' => 'Мои уведомления', 'icon' => 'fa fa-bell'],
                            ['label' => 'Мои сообщения', 'icon' => 'fa fa-envelope'],
                        ] as $link)
                            <a
                                href="/"
                                class="nav-link px-0 disabled"
                                title="{{ $link['label'] }}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                            >
                                <i class="{{ $link['icon'] }}" style="font-size: 30px;"></i>
                                <small class="badge badge-pill text-light bg-danger" style="top: 10px;">
                                    99
                                </small>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="nav-item">
                    <a
                        href="{{ route('users.show', [$user, $user->username]) }}"
                        @class([
                            'nav-link', 'lh-1', 'p-2',
                            'bg-azure-lt' => request()->user?->equals($user) && request()->routeIs('users.show')
                        ])
                    >
                        <span class="avatar avatar-sm" style="background-image: url('{{ $user->gravatar() }}');"></span>
                        <div class="d-none d-lg-block ps-2">
                            <div class="fw-bold">
                                {{ $user->nickname }}
                            </div>
                            <div class="mt-1 small text-muted text-uppercase">Профиль</div>
                        </div>
                    </a>
                </div>
            @endguest
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            {{-- BEGIN NAVBAR MENU --}}
            <ul class="navbar-nav">
                {{-- BEGIN GAMES --}}
                <li class="nav-item dropdown">
                    <a @class([
                        'nav-link', 'dropdown-toggle',
                        'bg-azure-lt' => request()->routeIs(['games.showcase', 'games'])
                    ]) href="#navbar-games" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-gamepad-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5h3.5a5 5 0 0 1 0 10h-5.5l-4.015 4.227a2.3 2.3 0 0 1 -3.923 -2.035l1.634 -8.173a5 5 0 0 1 4.904 -4.019h3.4"/>
                                <path d="M14 15l4.07 4.284a2.3 2.3 0 0 0 3.925 -2.023l-1.6 -8.232"/>
                                <path d="M8 9v2"/>
                                <path d="M7 10h2"/>
                                <path d="M14 10h2"/>
                            </svg>
                        </span>
                        <span class="nav-link-title"> Игры</span>
                    </a>
                    <div class="dropdown-menu">
                        @foreach(GameProviderEnum::cases() as $provider)
                            <a href="{{ route('games', $provider) }}" @class([
                                'dropdown-item',
                                'active' => request()->routeIs('games') && request()->route('provider') === $provider
                            ])>{{ $provider->label() }}</a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('games.showcase') }}" @class([
                            'dropdown-item', 'active' => request()->routeIs('games.showcase')
                        ])>Витрина</a>
                    </div>
                </li>
                {{-- BEGIN DEVELOPERS --}}
                <li class="nav-item dropdown">
                    <a @class([
                        'nav-link', 'dropdown-toggle',
                        'bg-azure-lt' => request()->routeIs(['developers.showcase', 'developers'])
                    ]) href="#navbar-developers" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-code">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 8l-4 4l4 4"/>
                                <path d="M17 8l4 4l-4 4"/><path d="M14 4l-4 16"/>
                            </svg>
                        </span>
                        <span class="nav-link-title"> Разработчики</span>
                    </a>
                    <div class="dropdown-menu">
                        @foreach(GameProviderEnum::cases() as $provider)
                            <a href="{{ route('developers', $provider) }}" @class([
                                'dropdown-item',
                                'active' => request()->routeIs('developers') && request()->route('provider') === $provider
                            ])>{{ $provider->label() }}</a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('developers.showcase') }}" @class([
                            'dropdown-item', 'active' => request()->routeIs('developers.showcase')
                        ])>Витрина</a>
                    </div>
                </li>
                {{-- BEGIN USERS --}}
                <li class="nav-item">
                    <a href="{{ route('users') }}" @class(['nav-link', 'bg-azure-lt' => request()->routeIs('users')])>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 7a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
                            </svg>
                        </span>
                        <span class="nav-link-title"> Пользователи</span>
                    </a>
                </li>
            </ul>
            {{-- END NAVBAR MENU --}}
        </div>
    </div>
</header>
@if (session()->has('flash'))
    {{-- @todo move to componet --}}
    <div class="container">
        <div class="alert alert-{{ session('flash.type') }} alert-dismissible fade show m-0 mt-4" role="alert">
            <span>{!! session('flash.message') !!}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
