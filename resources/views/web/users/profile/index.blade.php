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
                                <img src="{{ gravatar($user->email, 2048) }}" alt="" class="bg-info rounded-5">
                                @auth
                                @if($user->equals(request()->user()))
                                <form action="{{ route('logout') }}" method="post" class="mt-4">
                                    @csrf
                                    <button type="submit" class="btn btn-light rounded-5 w-100">
                                        <i class="fas fa-sign-out-alt" style="font-size: 16px;"></i>
                                        Выход
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </div>
                            <div class="col-lg-6 align-self-start">
                                <div class="main-info header-text">
                                    <span>Online</span>
                                    <h4>{{ $user->nickname }} <small class="text-muted">{{ '@' . $user->username }}</small></h4>
                                    <p>Any details such as age, occupation or city. Example: 23 y.o. designer from San Francisco</p>
                                    <div class="main-border-button">
                                        {{-- buttons --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 align-self-start">
                                <ul>
                                    <li>Игры <span><a href="">32</a></span></li>
                                    <li>Обзоры <span><a href="">1</a></span></li>
                                    <li>Отзывы <span><a href="">16</a></span></li>
                                    <li>Комментарии <span><a href="">3</a></span></li>
                                </ul>
                            </div>
                        </div>
                        {{-- contect --}}
                    </div>
                </div>
            </div>
            <!-- ***** Banner End ***** -->
        </div>
    </div>
</x-layouts::main>
