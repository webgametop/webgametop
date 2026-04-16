@props(['user'])

@section('title', 'Редактировать аккаунт')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('users.edit.account', $user) }}
    </div>
    {{--<div class="page-header">
        <div class="container">
            <div class="page-title">{{ $user->nickname }}</div>
            <div class="text-secondary">Редактировать профиль</div>
        </div>
    </div>--}}
    <div class="page-body">
        <div class="container">
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
</x-layouts::main>
