<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePastRequest;
use App\Http\Resources\Past as PastResource;
use App\Models\Past;
use Illuminate\Http\Response;

final class PastApiController extends Controller
{
    /**
     * @param \App\Http\Requests\CreatePastRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePastRequest $request): Response
    {
        $past = new Past;

        $past->encrypted = $request->encrypted;
        $past->setExpireFromPeriode($request->expire);

        $past->save();

        return response(new PastResource($past), Response::HTTP_CREATED);
    }
}
