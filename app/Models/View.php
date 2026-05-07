<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\ViewBuilder;
use Database\Factories\ViewFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[UseEloquentBuilder(ViewBuilder::class)]
class View extends Model
{
    /** @use HasFactory<ViewFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'entity_type',
        'entity_id',
        'user_id',
        'dedup_hash',
    ];

    public static function query(): ViewBuilder
    {
        /** @var ViewBuilder */
        return parent::query();
    }

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
