@section('title', 'Вход')

<x-layouts::main>
    <div class="container">
        <div class="page-content">
            <div class="heading-section">
                <h4 class="m-0">Авторизация</h4>
                <h5>На данной странице вы сможете авторизоваться на нашем сайте.</h5>
            </div>
            <hr>
            @if($errors->count())
            <div class="text-danger mb-4">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="col-12 col-lg-4">
                    <div class="mb-4">
                        <label for="user_email" class="form-label text-white">Адрес электронной почты (Email)</label>
                        <input type="email" name="user[email]" id="user_email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="user_password" class="form-label text-white">Пароль</label>
                        <input type="password" name="user[password]" id="user_password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" name="user[remember]" id="user_remember" value="1">
                        <label for="user_remember" class="form-label text-white">Запомнить меня</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-light rounded-5">Войти</button>
                <a href="{{ route('register') }}" class="ms-3">Зарегистрировать новый аккаунт</a>
                <a href="" class="ms-3">Забыли пароль?</a>
            </form>
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
