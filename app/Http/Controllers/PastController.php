<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Past;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

final class PastController extends Controller
{
    /**
     * @var \Illuminate\Contracts\View\Factory
     */
    private $view;

    /**
     * PastController constructor.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     */
    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return $this->view->make('past.create');
    }

    /**
     * @param \App\Models\Past $past
     *
     * @return \Illuminate\View\View
     */
    public function view(Past $past): View
    {
        return $this->view->make('past.view')->with(compact('past'));
    }
}
