@section('title', 'Вход')

<x-layouts::main>
    <div class="container">
        <div class="page-content">
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <input type="email" name="user[email]" id="user_email" class="form-control" placeholder="Email">
            </form>
        </div>
    </div>
</x-layouts::main>
