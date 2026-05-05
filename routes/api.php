<?php

use App\Http\Controllers\API\GameVoteController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api'], function () {
    Route::group(['prefix' => 'games', 'as' => '.games'], function () {
        Route::post('/{game}/votes', [GameVoteController::class, 'store'])->name('.votes.store');
    }); # games
    Route::post('/views/increment', function (
        \App\Services\Security\HmacHasherService $hmacService,
    ) { // @todo refactored
        // 1. Идентификатор пользователя
        $userId = auth()->check() ? auth()->id() : sha1(request()->ip() . request()->userAgent());
        // 2. Объект просмотра
        $viewableType = request()->get('viewable_type');
        $viewableId = request()->get('viewable_id');
        // 3. Окно 30 минут
        $windowSize = 1800;
        $windowStart = intdiv(now()->timestamp, $windowSize);
        // 4. Строка для дедупликации
        $dedupString = implode('|', [$userId, $viewableType, $viewableId, $windowStart]);
        // 5. Бинарный хеш
        $dedupHash = $hmacService->hash($dedupString, \App\Enums\HashingFormat::BINARY);
        // 6. Вставка с игнорированием дубликата
        if (! \App\Models\View::query()->where('dedup_hash', $dedupHash)->exists()) {
            $model = app($viewableType)->find($viewableId);
            $model->views()->save(\App\Models\View::make(['dedup_hash' => $dedupHash]));

            return response()->json(['ok' => true, 'message' => 'View is initialized.']);
        }

        return response()->json(['ok' => false, 'error' => 'View does not exist.']);
    })->name('views.increment');
}); # V1
