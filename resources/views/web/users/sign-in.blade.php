@section('title', 'Вход')

<x-layouts::main>
    <div class="page-header">
        <div class="container">
            <h2 class="page-title">Авторизация</h2>
            <div class="text-secondary">На данной странице вы сможете авторизоваться на нашем сайте.</div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            @if($errors->count())
                <div class="text-danger mb-4">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="col-12 col-lg-4">
                    <div class="mb-4">
                        <label for="user_email" class="form-label">Адрес электронной почты (Email)</label>
                        <input type="email" name="user[email]" id="user_email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="user_password" class="form-label">Пароль</label>
                        <input type="password" name="user[password]" id="user_password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="user_remember" class="form-label">
                            <input type="checkbox" name="user[remember]" id="user_remember" value="1">
                            Запомнить меня
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" data-loading-text="Вход...">Войти</button>
                <a href="{{ route('register') }}" class="ms-3">Зарегистрировать новый аккаунт</a>
                <a href="" class="ms-3">Забыли пароль?</a>
            </form>
        </div>
    </div>
    @push('body-script')
    @endpush
</x-layouts::main>
