<?php

namespace App\Pantheon\Bloom;

use App\Pantheon\Bloom\Bloom\Bloom;

/**
 * Class View
 */
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