@props(['commentable', 'comments', 'label' => 'Комментарии'])

@if(auth()->check())
    <x-ui.subheadline label="Твой комментарий">
        @if($errors->count())
            <div class="text-danger mb-3">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('comments.store') }}" method="post">
            @csrf
            <input type="hidden" name="commentable[type]" value="{{ morph_alias($commentable::class) }}" autocomplete="off">
            <input type="hidden" name="commentable[id]" value="{{ $commentable->id }}" autocomplete="off">
            @if(! is_null($comment_id = request()->comment?->id))
                <input type="hidden" name="comment[parent_id]" value="{{ $comment_id }}" autocomplete="off">
            @endif
            <textarea
                name="comment[body]"
                cols="30" rows="5"
                class="form-control rounded-0 mb-3"
                required
            >{{ request()->old('comment.body') }}</textarea>
            <div class="text-end">
                <button type="submit" class="btn btn-sm btn-primary" data-loading-text="Отправка...">Отправить</button>
            </div>
        </form>
    </x-ui.subheadline>
@endif

<x-ui.subheadline :label="$label">
    <div class="scrollable">
        <div class="chat">
            <div class="chat-bubbles">
                @forelse($comments as $comment)
                    @php($user = $comment->user)
                    @php($is_equals = $user->equals(auth()->user()))
                    <div class="chat-item">
                        <div @class([
                            'row', 'align-items-end',
                            'justify-content-end flex-row-reverse' => $is_equals
                        ])>
                            <div class="col-auto">
                                <a href="{{ route('users.show', [$user, $user->username]) }}" title="Профиль">
                                    <span class="avatar avatar-1" style="background-image: url({{ $user->gravatar() }})"></span>
                                </a>
                            </div>
                            <div class="col">
                                <div @class(['chat-bubble', 'border', 'bg-blue-lt' => $is_equals])>
                                    <div class="chat-bubble-title">
                                        <div class="row">
                                            <div class="col chat-bubble-author">
                                                <a href="{{ route('users.show', [$user, $user->username]) }}">
                                                    <b>{{ $user->nickname }}</b>
                                                </a>
                                                <span class="text-muted">{{ $comment->created_at->ago() }}</span>
                                                <a href="{{ route('comments.show', $comment) }}">
                                                    {{ '#' . $comment->id }}
                                                </a>
                                            </div>
                                            @if(auth()->check())
                                                <div class="col-auto chat-bubble-date">
                                                    <a href="#" title="Жалоба">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-flag">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M4 5a1 1 0 0 1 .3 -.714a6 6 0 0 1 8.213 -.176l.351 .328a4 4 0 0 0 5.272 0l.249 -.227c.61 -.483 1.527 -.097 1.61 .676l.005 .113v9a1 1 0 0 1 -.3 .714a6 6 0 0 1 -8.213 .176l-.351 -.328a4 4 0 0 0 -5.136 -.114v6.552a1 1 0 0 1 -1.993 .117l-.007 -.117v-16z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="chat-bubble-body">
                                        <p style="white-space: pre-wrap;">{{ $comment->body }}</p>
                                    </div>
                                    <div class="text-muted text-end">
                                        @if(! is_null($comment->parent_id))
                                            <div class="me-2">
                                                <b>ответ</b>
                                                <a href="{{ route('comments.show', $comment->parent) }}">
                                                    <b>{{ '#' . $comment->parent_id }}</b>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <x-ui.card>
                        <span class="text-muted">Нет комментариев</span>
                    </x-ui.card>
                @endforelse
            </div>
        </div>
    </div>
</x-ui.subheadline>

<div class="col-lg-12 mt-5">
    {{ $comments->onEachSide(0)->links('vendor.pagination.bootstrap-5') }}
</div>

@pushonce('body-script')
    <script type="module">
        $(function () { $('.icons-tabler-filled').on('click', () => alert('Работаем над реализацией.')); });
    </script>
@endpushonce
