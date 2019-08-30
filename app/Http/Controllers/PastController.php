<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\Past;
use Illuminate\View\View;

final class PastController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('past.create');
    }

    /**
     * @param \App\Entities\Past $past
     *
     * @return \Illuminate\View\View
     */
    public function view(Past $past): View
    {
        return view('past.view')->with(compact('past'));
    }
}
