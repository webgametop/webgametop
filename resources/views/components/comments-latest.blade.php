@props(['comments'])

<div class="swiper comments-latest">
    <div class="swiper-wrapper">
        @foreach($comments as $comment)
            @php($commentable = $comment->commentable)
            <div class="swiper-slide d-flex">
                <div class="card d-flex flex-column flex-grow-1">
                    <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1 text-secondary">
                            {{ $comment->body }}
                        </div>
                        <a href="{{ $commentable->url }}">
                            <b>{{ $commentable->display }}</b>
                        </a>
                    </div>
                    <div class="card-footer">
                        @php($user = $comment->user)
                        <a href="{{ route('users.show', [$user, $user->username]) }}">
                            <b>{{ $user->nickname }}</b>
                        </a>
                        <span class="text-muted">
                            {{ $comment->created_at->ago() }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper-scrollbar"></div>
</div>
<style>
    .comments-latest .swiper-wrapper {
        min-height: 245px;
    }
    .comments-latest .swiper-slide {
        height: auto;
    }
</style>
@pushonce('body-script')
    <script type="module">
        new swiper('.comments-latest',
            {
                loop: false,
                slidesPerView: 3,
                spaceBetween: 10,
                scrollbar: {
                    el: ".swiper-scrollbar",
                    hide: true,
                },
            }
        );
    </script>
@endpushonce
