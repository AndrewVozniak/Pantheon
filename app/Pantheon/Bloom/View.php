<?php

namespace App\Pantheon\Bloom;

use App\Pantheon\Bloom\Bloom\Bloom;

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