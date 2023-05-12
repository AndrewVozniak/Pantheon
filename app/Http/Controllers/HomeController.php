<?php

namespace App\Http\Controllers;


/**
 * Class HomeController | Page: /
 */
class HomeController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(): void
    {
        render('index', ['name' => 'John', 'someArray' => ['one', 'two', 'three'], 'emptyArray' => [], 'title' => 'Home Page']);
    }
}