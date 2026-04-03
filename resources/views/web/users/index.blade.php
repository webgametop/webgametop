@props(['users'])

@section('title', 'Пользователи')

<x-layouts::main>
    <style>.gaming-library .item ul li { margin-top: 30px; }</style>
    <div class="container">
        <div class="page-content">
            <div class="heading-section">
                <h4 class="m-0">Пользователи</h4>
                <h5>В данном разделе представлены все пользователи сайта, отсортированные по дате последнего посещения.</h5>
            </div>
            <hr>
            <div class="gaming-library mt-0">
                <div class="col-lg-12">
{{--                    <div class="heading-section">--}}
{{--                        <h4><em>Пользователи</em> по дате последнего посещения</h4>--}}
{{--                    </div>--}}
                    @foreach($users as $user)
                    <div class="item">
                        <ul class="d-flex">
                            <li><img src="{{ $user->gravatar() }}" alt="" class="templatemo-item bg-info rounded-4"></li>
                            <li><h4>{{ $user->nickname }}</h4><span @class(['text-success' => $user->isOnline()])>{{ $user->isOnline() ? 'Online' : 'Offline' }}</span></li>
                            <li><h4 class="text-uppercase">Регистрация</h4><span>{{ $user->created_at->ago() }}</span></li>
                            <li class="flex-grow-1">
                                <div class="main-border-button"><a href="{{ route('users.show', [$user, $user->username]) }}">Профиль</a></div>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-12">
                    <div class="main-button">
                        {{ $users->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::main>
