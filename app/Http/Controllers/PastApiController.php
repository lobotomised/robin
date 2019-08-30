<?php

namespace App\Http\Controllers;

use App\Entities\Past;
use App\Http\Requests\CreatePastRequest;
use App\Http\Resources\Past as PastResource;
use App\Repositories\PastRepositoryInterface;
use App\Support\Carbon;
use Illuminate\Http\Response;

final class PastApiController extends Controller
{
    /**
     * @var \App\Repositories\PastRepository
     */
    private $past;

    /**
     * PastApiController constructor.
     *
     * @param \App\Repositories\PastRepositoryInterface $past
     */
    public function __construct(PastRepositoryInterface $past)
    {
        $this->past = $past;
    }

    /**
     * @param \App\Http\Requests\CreatePastRequest $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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

        $past->setExpireAt(Carbon::createFromPeriode($request->expire));
        $past->setEncrypted($request->encrypted);

        $past = $this->past->save($past);

        return response(new PastResource($past), Response::HTTP_CREATED);
    }

}
