<?php

namespace App\Http\Controllers;
class PostController extends Controller
{
    public function index() : void
    {
        echo "PostController is running";
    }

    public function show(int $id, string $name) : void
    {
        echo "PostController is running with id: " . $id . " and name: " . $name;
    }
}