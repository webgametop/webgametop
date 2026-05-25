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
            <div class="badge bg-warning border text-white">
                <span title="Добавили в избранное">{{ $game->favorites_count }}</span>
            </div>
        </a>
    @empty
        <a class="list-group-item list-group-item-action disabled bg-indigo-lt h-100">
            <div><b>Ой! Похоже, здесь ничего нет.</b></div>
            <div class="my-2">Раздел в разработке. Скоро здесь появится что-то интересное!</div>
        </a>
    @endforelse
</div>
