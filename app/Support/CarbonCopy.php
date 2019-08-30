<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\Carbon;

class CarbonCopy extends Carbon
{
    /**
     * @param string $periode
     *
     * @return \Carbon\Carbon
     */
    public static function createFromPeriode(string $periode): Carbon
    {
        switch ($periode) {
            case '5m':
                return Carbon::now()->addMinutes(5);

                break;
            case '1h':
                return Carbon::now()->addHour();

                break;
            case '1d':
                return Carbon::now()->addDay();

                break;
            // '1w' correspond au cas par défaut, il va être ignoré ici
            case '1m':
               return Carbon::now()->addMonth();

                break;
            case '1y':
                return Carbon::now()->addYear();

                break;
            default:
                return Carbon::now()->addWeek();

                break;
        }

    }
}
