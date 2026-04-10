@props(['users'])

@section('title', 'Пользователи')

<x-layouts::main>
    <div class="page-header">
        <div class="container">
            <h2 class="page-title">Пользователи</h2>
            <div class="text-secondary">В данном разделе представлены все пользователи сайта, отсортированные по дате последнего посещения.</div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <div class="row row-cards">
                @foreach($users as $user)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar avatar-xl bg-azure-lt" style="background-image: url('{{ $user->gravatar() }}')"></span>
                                    </div>
                                    <div class="col">
                                        <h4 class="card-title m-0">
                                            {{ $user->nickname }}
                                        </h4>
                                        <div>
                                            <span @class(['badge bg-danger', 'bg-green' => $user->isOnline()])></span>
                                            {{ $user->isOnline() ? 'сейчас на сайте' : 'в сети:' . $user->last_seen_at->ago() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('users.show', [$user, $user->username]) }}" class="btn">Профиль</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layouts::main>
