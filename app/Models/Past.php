<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\PastCreated;
use App\Models\Concerns\UsesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property string encrypted
 * @property $this expire_at
 * @method static Builder|Past expired()
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

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('expire_at', '<=', Carbon::now());
    }
}
