<?php

declare(strict_types=1);

namespace App\Support;

use http\Exception\UnexpectedValueException;

class Carbon extends \Carbon\Carbon
{
    /**
     * @param string $periode
     *
     * @return \Carbon\Carbon
     */
    public static function createFromPeriode(string $periode): \Carbon\Carbon
    {
        switch ($periode) {
            case '5m':
                return \Carbon\Carbon::now()->addMinutes(5);

                break;
            case '1h':
                return \Carbon\Carbon::now()->addHour();

                break;
            case '1d':
                return \Carbon\Carbon::now()->addDay();

                break;
            case '1w':
                return \Carbon\Carbon::now()->addWeek();

                break;
            case '1m':
               return \Carbon\Carbon::now()->addMonth();

                break;
            case '1y':
                return \Carbon\Carbon::now()->addYear();

                break;
        }

        throw new UnexpectedValueException('periode parameter have an unsupported value');
    }
}
