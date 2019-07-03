<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePastRequest;
use App\Models\Past;
use Illuminate\Http\Response;

class PastApiController extends Controller
{

    /**
     * @param \App\Http\Requests\CreatePastRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePastRequest $request): Response
    {
        switch ($request->expire) {
            case '5m':
                $expire = now()->addMinutes(5);
                break;
            case '1h':
                $expire = now()->addHour();
                break;
            case '1d':
                $expire = now()->addDay();
                break;
            case '1w':
                $expire = now()->addWeek();
                break;
            case '1m':
                $expire = now()->addMonth();
                break;
            case '1y':
                $expire = now()->addYear();
                break;
            default:
                $expire = now()->addWeek();
                break;
        }

        $past = new Past;
        $past->encrypted = $request->encrypted;
        $past->expire_at = $expire;

        $past->save();

        return response(new \App\Http\Resources\Past($past), Response::HTTP_CREATED);
    }
}
