<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav justify-content-between">
                    <!-- ***** Logo Start ***** -->
                    <a href="/">
                        <h1 class="text-uppercase">{{ config('app.name') }}</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="/">Главная</a></li>
                        <li><a href="{{ route('users') }}" class="{{ request()->routeIs('users') ? 'active' : '' }}">Пользователи</a></li>
                        <li class="pe-0">
                            @guest
                            <a
                                href="{{ route('login') }}"
                                @class(['active' => request()->routeIs(['login', 'register'])])
                            >
                                <span>Вход | Регистрация</span>
                                <img src="/build/assets/images/profile.jpg" alt="">
                            </a>
                            @else
                            @php($user = auth()->user())
                            <a
                                href="{{ route('users.show', [$user, $user->username]) }}"
                                @class(['active' => request()->user?->equals($user) && request()->routeIs('users.show')])
                            >
                                <span>Профиль</span>
                                <img src="{{ gravatar($user->email, 2048) }}" alt="" class="bg-info rounded-5">
                            </a>
                            @endguest
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
