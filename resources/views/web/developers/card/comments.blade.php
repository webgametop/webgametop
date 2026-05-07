@props(['developer', 'provider'])

@section('title', 'Комментарии')

<x-layouts::main>
    <div class="container mt-4">
        {{ Breadcrumbs::render('developers.comments', $provider, $developer) }}
    </div>
    <div class="container">
        <x-developers-card :developer="$developer">
            <form action="{{ route('developers.comments.store', [$developer, $developer->slug]) }}" method="post">
                @csrf
                <textarea
                    name="comment[body]"
                    id="comment_body"
                    cols="30"
                    rows="5"
                    placeholder="Оставить комментарий"
                    class="form-control mb-3"
                    required
                ></textarea>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary" data-loading-text="Отправка...">Отправить</button>
                </div>
            </form>
            <hr class="my-3">
            @forelse($comments as $comment)
                <div>
                    <code>{{ $comment->created_at }}</code> {{ $comment->body }}
                </div>
            @empty
                <div>Пусто</div>
            @endforelse
            <div class="col-lg-12 mt-5">
                {{ $comments->onEachSide(0)->links('vendor.pagination.bootstrap-5') }}
            </div>
        </x-developers-card>
    </div>
</x-layouts::main>
