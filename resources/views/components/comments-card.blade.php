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
            <input type="hidden" name="comment[author_id]" value="{{ auth()->id() }}" autocomplete="off">
            <textarea name="comment[body]" cols="30" rows="5" class="form-control rounded-0 mb-3" required>{{ request()->old('comment.body') }}</textarea>
            <div class="text-end">
                <button type="submit" class="btn btn-sm btn-primary" data-loading-text="Отправка...">Отправить</button>
            </div>
        </form>
    </x-ui.subheadline>
@endif

<div class="scrollable">
    <div class="chat">
        <x-ui.subheadline :label="$label"/>
        <div class="chat-bubbles">
            @forelse($comments as $comment)
                @php($user = $comment->user)
                <div class="chat-item">
                    <div @class(['row', 'align-items-end', 'justify-content-end flex-row-reverse' => auth()->id() === $user->id])>
                        <div class="col-auto">
                            <a href="{{ route('users.show', [$user, $user->username]) }}" title="Профиль">
                                <span class="avatar avatar-1" style="background-image: url({{ $user->gravatar() }})"></span>
                            </a>
                        </div>
                        <div class="col">
                            <div @class(['chat-bubble', 'border', 'bg-azure-lt' => auth()->id() === $user->id])>
                                <div class="chat-bubble-title">
                                    <div class="row">
                                        <div class="col chat-bubble-author">
                                            <span>{{ $user->nickname }}</span>
                                            <a href="{{ route('comments.show', $comment) }}">
                                                <span class="text-muted">{{ '#' . $comment->id }}</span>
                                            </a>
                                        </div>
                                        <div class="col-auto chat-bubble-date d-flex">
                                            @if(! is_null($comment->parent_id))
                                                <div class="me-2">
                                                    <span>ответ</span>
                                                    <a href="{{ route('comments.show', $comment->parent) }}">
                                                        <b class="text-muted">{{ '#' . $comment->parent_id }}</b>
                                                    </a>
                                                </div>
                                            @endif
                                            <span class="text-muted" title="{{ $comment->created_at->format('Y/m/d H:i:s') }}">{{ $comment->created_at->ago() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-bubble-body">
                                    <p>{{ $comment->body }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-muted">Нет комментариев</div>
            @endforelse
        </div>
    </div>
</div>

<div class="col-lg-12 mt-5">
    {{ $comments->onEachSide(0)->links('vendor.pagination.bootstrap-5') }}
</div>
