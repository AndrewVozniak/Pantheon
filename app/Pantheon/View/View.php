<?php

namespace App\Pantheon\View;

use App\Pantheon\View\Bloom\Bloom;

class View
{
    /**
     * @throws \Exception
     */
    public static function render($name, $data = []) : void
    {
        $bloom = new Bloom();

        echo $bloom->render($name, $data);
    }
}