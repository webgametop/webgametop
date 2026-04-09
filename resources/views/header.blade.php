<header class="navbar navbar-expand-md py-2">
    <div class="container justify-content-start align-items-center">
        <button
            class="navbar-toggler mx-1 me-3 collapsed"
            style="font-size: 25px;"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="h1 navbar-brand navbar-brand-autodark d-none-navbar-horizontal me-auto p-0 pe-3">
            <a href="/" class="text-decoration-none text-uppercase" title="Главная">
                {{ config('app.name') }}
            </a>
        </div>
        @if($boosty_url = config('boosty.url'))
            <div class="d-none d-md-block pe-2">
                <a
                    href="{{ $boosty_url }}"
                    class="btn py-2"
                    target="_blank"
                    rel="noreferrer"
                    title="Внести свой вклад в развитие проекта"
                >
                    <img
                        style="margin-right: 10px;"
                        src="{{ asset('static/media/boosty.png') }}"
                        width="18"
                        alt="Boosty"
                    >
                    <span class="text-uppercase">Стать спонсором</span>
                </a>
            </div>
        @endif
        <div class="flex-grow-1 d-none d-md-block pe-3">
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
                <div class="nav-item me-3 d-none d-md-flex">
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
                <div class="nav-item me-2">
                    <a
                        href="{{ route('users.show', [$user, $user->nickname]) }}"
                        @class([
                            'nav-link', 'lh-1', 'p-2',
                            'bg-azure-lt' => request()->user?->equals($user) && request()->routeIs('users.show')
                        ])
                    >
                        <span class="avatar avatar-sm" style="background-image: url('{{ $user->gravatar() }}');"></span>
                        <div class="d-none d-sm-block ps-2">
                            <div class="fw-bold">
                                {{ $user->nickname }}
                            </div>
                            <div class="mt-1 small text-muted text-uppercase">Профиль</div>
                        </div>
                    </a>
                </div>
                <div class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button
                            type="submit"
                            class="nav-link p-2"
                            title="Выйти"
                            data-bs-toggle="tooltip"
                            data-bs-placement="bottom"
                        >
                            <i class="fas fa-sign-out-alt" style="font-size: 30px;"></i>
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</header>
