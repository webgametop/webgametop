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
            <x-oops/>
        </div>
    </div>
</x-layouts::main>
