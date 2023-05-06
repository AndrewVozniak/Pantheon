<?php

namespace App\Pantheon;
class App
{
    public static function run()
    {
        echo '<pre>';
        var_dump($_SERVER['REQUEST_URI']);
        echo '</pre>';
    }
}