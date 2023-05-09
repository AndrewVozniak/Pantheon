<?php

namespace App\Http\Controllers;

use App\Pantheon\View\View;

class HomeController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index() : void
    {
        View::render('index', ['name' => 'John', 'someArray' => ['one', 'two', 'three']]);
    }
}