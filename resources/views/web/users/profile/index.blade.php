@props(['user'])

@section('title', "Профиль $user->nickname")

<x-layouts::main>
    <div class="container">
        <div class="page-content">
            <!-- ***** Banner Start ***** -->
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
                                    <button type="submit" class="btn btn-light text-start rounded-5 w-100">
                                        <i class="fas fa-sign-out-alt" style="font-size: 16px;"></i>
                                        <span class="ms-1">Выход</span>
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
                                    <a href="" class="w-100">Редактировать профиль</a>
                                </div>
                                @endif
                                @endauth
{{--                                <ul class="mb-4">--}}
{{--                                    <li data-badges>Значки <span><a href="">0</a></span></li>--}}
{{--                                    <li data-achievements>Достижения <span><a href="">0</a></span></li>--}}
{{--                                </ul>--}}
                                <ul class="mb-4">
                                    <li data-games>Игры <span><a href="">32</a></span></li>
                                    <li data-reviews>Обзоры <span><a href="">1</a></span></li>
                                    <li data-feedbacks>Отзывы <span><a href="">16</a></span></li>
                                    <li data-comments>Комментарии <span><a href="">3</a></span></li>
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
            <!-- ***** Banner End ***** -->
        </div>
    </div>
    @push('body-script')
    <script type="module">
        $('form').on('submit', function () {
            const $button = $(this).find('button');
            $button.prop('disabled', true);
            $button.html([
                $('<span>', { 'class': 'spinner-border spinner-border-sm', 'aria-hidden': true}),
                $('<span>', { 'class': 'ms-2', 'role': 'status', 'text': 'Выход...'}),
            ]);
        });
    </script>
    @endpush
</x-layouts::main>
