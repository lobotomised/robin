<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\PastCreated;
use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property string encrypted
 * @property $this expire_at
 */
final class Past extends Model
{
    use UsesUuid;

    protected $fillable = [
        'encrypted',
        'expire_at',
    ];

    protected $casts = [
        'expire_at' => 'datetime',
    ];

    protected $hidden = [
        'encrypted',
    ];

    protected $dispatchesEvents = [
        'created' => PastCreated::class,
    ];
}
