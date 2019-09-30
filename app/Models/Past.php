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
 * @method static Builder|Past whereExpired()
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

    public function scopeWhereExpired(Builder $query): Builder
    {
        return $query->where('expire_at', '<=', Carbon::now());
    }

    /**
     * @param string $periode
     *
     * @return $this
     */
    public function setExpireFromPeriode(string $periode): self
    {
        switch ($periode) {
            case '5m':
                $this->attributes['expire_at'] =  Carbon::now()->addMinutes(5);

                break;
            case '1h':
                $this->attributes['expire_at'] =  Carbon::now()->addHour();

                break;
            case '1d':
                $this->attributes['expire_at'] =  Carbon::now()->addDay();

                break;
            // '1w' correspond au cas par défaut, il va être ignoré ici
            case '1m':
                $this->attributes['expire_at'] =  Carbon::now()->addMonth();

                break;
            case '1y':
                $this->attributes['expire_at'] =  Carbon::now()->addYear();

                break;
            default:
                $this->attributes['expire_at'] =  Carbon::now()->addWeek();

                break;
        }

        return $this;
    }
}
