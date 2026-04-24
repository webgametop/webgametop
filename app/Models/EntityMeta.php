<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\EntityMetaBuilder;
use Database\Factories\EntityMetaFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[UseEloquentBuilder(EntityMetaBuilder::class)]
class EntityMeta extends Model
{
    /** @use HasFactory<EntityMetaFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'entity_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
