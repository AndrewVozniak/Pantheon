<?php

namespace App\Http\Controllers;

use App\Models\User;

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
//        $user = new User();
//        $user->name = 'John Doe';
//        $user->email = 'john@example.com';
//        $user->another_one = '123123';
//        $user->save();
//
//        $user = User::find(6);
//        dd($user->name);

//        $user = User::find(2);
//        $user->name = 'John Dose';
//        $user->save();
//        $user->delete();
//        dd($user->name);

//        User::delete(2);
        render('index', ['name' => 'John', 'someArray' => ['one', 'two', 'three'], 'emptyArray' => [], 'title' => 'Home Page']);
    }
}