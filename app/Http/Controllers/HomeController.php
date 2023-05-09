<?php

namespace App\Http\Controllers;
class HomeController extends Controller
{
    public function index() : void
    {
        echo "Homepage" . $_GET['name'];
    }
}