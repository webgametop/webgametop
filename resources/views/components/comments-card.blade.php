@props(['action', 'comments'])

@if(auth()->check())
    <div class="card bg-azure-lt mb-3">
        <div class="card-body p-3">
            <form action="{{ $action }}" method="post">
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
                    <button type="submit" class="btn btn-sm btn-primary" data-loading-text="Отправка...">Отправить</button>
                </div>
            </form>
        </div>
    </div>
@endif
<div class="scrollable">
    <div class="chat">
        <x-ui.subheadline label="Лента"/>
        <div class="chat-bubbles">
            @forelse($comments as $comment)
                @php($user = $comment->user)
                <div class="chat-item">
                    <div @class(['row', 'align-items-end', 'justify-content-end flex-row-reverse' => auth()->id() === $user->id])>
                        <div class="col-auto">
                            <span class="avatar avatar-1" style="background-image: url({{ $user->gravatar() }})"></span>
                        </div>
                        <div class="col">
                            <div @class(['chat-bubble', 'border', 'bg-azure-lt' => auth()->id() === $user->id])>
                                <div class="chat-bubble-title">
                                    <div class="row">
                                        <div class="col chat-bubble-author">{{ $user->nickname }}</div>
                                        <div class="col-auto chat-bubble-date">
                                            <span class="text-muted">{{ $comment->created_at->format('Y/m/d H:i') }}</span>
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
