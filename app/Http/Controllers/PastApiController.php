<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreatePastAction;
use App\Http\Requests\CreatePastRequest;
use App\Http\Resources\Past as PastResource;
use Illuminate\Http\Response;

final class PastApiController extends Controller
{
    public function store(CreatePastRequest $request, CreatePastAction $action): Response
    {
        $past = $action->handle($request->encrypted, $request->expire);

        return response(new PastResource($past), Response::HTTP_CREATED);
    }
}
