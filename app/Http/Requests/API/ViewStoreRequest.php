<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use App\Enums\HashingFormat;
use App\Enums\ViewableType;
use App\Services\Security\HmacHasherService;
use Illuminate\Validation\Rule;

/**
 * @property-read string $viewable_type
 * @property-read int $viewable_id
 * @property-read int $user_id
 */
class ViewStoreRequest extends Request
{
    public function __construct(
        private readonly HmacHasherService $hmacService,
    )
    {
        parent::__construct();
    }

    public function rules(): array
    {
        return [
            'viewable_type' => ['required', 'string', Rule::enum(ViewableType::class)],
            'viewable_id' => ['required', 'integer'],
            'user_id' => ['integer', 'nullable'],
        ];
    }

    /**
     * @return array{
     *     viewable_type: string,
     *     viewable_id: int,
     *     user_id: int,
     *     dedup_hash: string,
     * }
     */
    public function extractRequestData(): array
    {
        $viewable_type = $this->input('viewable_type');
        $viewable_id = (int) $this->input('viewable_id');
        $user_id = is_null($this->input('user_id')) ? null : (int) $this->input('user_id');

        $visitor_id = $this->resolveVisitorId($user_id);
        $dedup_hash = $this->generateDedupHash($viewable_type, $viewable_id, $visitor_id);

        return [
            'viewable_type' => $viewable_type,
            'viewable_id' => $viewable_id,
            'user_id' => $user_id,
            'dedup_hash' => $dedup_hash,
        ];
    }

    private function resolveVisitorId(?int $user_id): string
    {
        return strval($user_id ?? md5($this->ip() . $this->userAgent()));
    }

    private function generateDedupHash(string $viewable_type, int $viewable_id, string $visitor_id): string
    {
        $window_size = 1800;
        $window_start = intdiv(now()->timestamp, $window_size);

        $dedup_string = implode('|', [$viewable_type, $viewable_id, $visitor_id, $window_start]);

        return $this->hmacService->hash($dedup_string, HashingFormat::BINARY);
    }
}
