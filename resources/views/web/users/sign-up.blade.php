@section('title', 'Регистрация')

<x-layouts::main>
    <div class="container">
        <div class="page-content">
            <div class="heading-section">
                <h4 class="m-0">Регистрация</h4>
                <h5>На данной странице вы сможете зарегистрироваться на нашем сайте.</h5>
            </div>
            <hr>
            <form action="{{ route('register.store') }}" method="post">
                @csrf
                <div class="col-12 col-lg-4">
                    <div class="mb-4">
                        <label for="user_email" class="form-label text-white">Адрес электронной почты (Email)</label>
                        <input type="email" name="user[email]" id="user_email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="user_password" class="form-label text-white">Придумайте пароль</label>
                        <input type="password" name="user[password]" id="user_password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-white">Повторите пароль</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="button" class="btn btn-light rounded-5">Зарегистрироваться</button>
                <a href="{{ route('login') }}" class="ms-3">Войти в уже существующий аккаунт</a>
                <a href="" class="ms-3">Забыли пароль?</a>
            </form>
        </div>
    </div>
</x-layouts::main>
