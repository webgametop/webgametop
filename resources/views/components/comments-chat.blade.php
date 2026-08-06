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
                            'row',
                            'align-items-end',
                            'justify-content-end flex-row-reverse' => $is_equals
                        ])>
                            <div class="col-auto">
                                <a href="{{ route('users.show', [$user, $user->username]) }}" title="Профиль">
                                    <span class="avatar avatar-1" style="background-image: url({{ $user->gravatar() }})"></span>
                                </a>
                            </div>
                            <div class="col align-self-stretch">
                                <div @class(['chat-bubble', 'border', 'h-100', 'bg-blue-lt' => $is_equals])>
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
                                                    <a href="#" title="Пожаловаться">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-alert-triangle">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="chat-bubble-body">
                                        <p style="white-space: pre-wrap;">{{ $comment->body }}</p>
                                    </div>
                                    @if(! is_null($comment->parent_id))
                                        <div class="text-muted text-end">
                                            <b>ответ</b>
                                            <a href="{{ route('comments.show', $comment->parent) }}">
                                                <b>{{ '#' . $comment->parent_id }}</b>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto align-self-stretch">
                                <div
                                    @class(['card', 'h-100', 'justify-content-center', $comment->rating_class])
                                    title="{{ $comment->likes_count }} плюсов / {{ $comment->dislikes_count }} минусов"
                                >
                                    @auth
                                        @if($comment->is_rating)
                                            <div class="text-center mx-lg-0 my-3" style="min-width: 40px;">{{ $comment->rating_total }}</div>
                                        @else
                                            <x-ratings-store
                                                :rateable="$comment"
                                                @class(['d-flex', 'flex-column', 'justify-content-between', 'h-100'])
                                           />
                                        @endif
                                    @else
                                        <div class="text-center mx-lg-0 my-3" style="min-width: 40px;">{{ $comment->rating_total }}</div>
                                    @endauth
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
        $(function () { $('.icon-tabler-flag').on('click', () => alert('Работаем над реализацией.')); });
    </script>
@endpushonce
