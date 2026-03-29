<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav justify-content-between">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html">
                        <img src="/build/assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.html">Главная</a></li>
                        <li style="padding-right: 0;">
                            @guest
                            <a href="{{ route('login') }}" class="{{ request()->routeIs(['login', 'register']) ? 'active' : '' }}">
                                <span>Вход | Регистрация</span>
                                <img src="/build/assets/images/profile-header.jpg" alt="">
                            </a>
                            @else
                            <a href="profile.html">
                                <span>Профиль</span>
                                <img src="/build/assets/images/profile-header.jpg" alt="">
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
