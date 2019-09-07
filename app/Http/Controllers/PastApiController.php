<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreatePastAction;
use App\Http\Requests\CreatePastRequest;
use App\Http\Resources\Past as PastResource;
use App\Support\CarbonCopy;
use Illuminate\Http\Response;

final class PastApiController extends Controller
{
    /**
     * @param \App\Http\Requests\CreatePastRequest $request
     *
     * @param \App\Actions\CreatePastAction $pastService
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePastRequest $request, CreatePastAction $pastService): Response
    {
        $past = $pastService($request->encrypted, CarbonCopy::createFromPeriode($request->expire));

        return response(new PastResource($past), Response::HTTP_CREATED);
    }
}
