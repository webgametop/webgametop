@props(['games'])

<div class="list-group list-group-flush border d-flex flex-column h-100">
    @forelse($games as $game)
        <a
            href="{{ route('games.show', [$game, $game->slug]) }}"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
        >
            <div>
                <div>{{ $game->title }}</div>
                <div><b class="text-muted">{{ $game->developer->name }}</b></div>
            </div>
            <div class="badge rounded-0 bg-warning text-white fs-4" title="Добавили в избранное">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                </svg>
                <span>{{ $game->favorites_count }}</span>
            </div>
        </a>
    @empty
        <a class="list-group-item list-group-item-action disabled bg-indigo-lt h-100">
            <div><b>Ой! Похоже, здесь ничего нет.</b></div>
            <div class="my-2">Раздел в разработке. Скоро здесь появится что-то интересное!</div>
        </a>
    @endforelse
</div>
