<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\DeveloperFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    /** @use HasFactory<DeveloperFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'provider',
        'identity',
        'title',
        'description',
    ];
}
