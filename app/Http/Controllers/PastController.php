<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePastRequest;
use App\Models\Past;
use App\Repositories\PastRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use function now;

class PastController extends Controller
{

    /**
     * @var \App\Repositories\PastRepository
     */
    private $pastRepository;

    public function __construct(PastRepository $pastRepository)
    {
        $this->pastRepository = $pastRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('past.create');
    }

    /**
     * @param \App\Http\Requests\CreatePastRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePastRequest $request): JsonResponse
    {
        switch ($request->encrypted) {
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

        return response()->json($past->id);
    }

    /**
     * @param \App\Models\Past $past
     *
     * @return \Illuminate\View\View
     */
    public function view(Past $past): View
    {
        return view('past.view');
    }
}
