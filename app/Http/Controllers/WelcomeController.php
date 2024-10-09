<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     * @param Request $request
     * @return View|Factory|Application
     */
    public function __invoke(Request $request): View|Factory|Application
    {

        return view('welcome');
    }
}
