<?php

namespace App\Pantheon\Helpers;

class TextHelper
{
    /** Beautify var_dump
     * @param $data
     * @return void
     */
    public static function dd($data)
    {
        echo '<pre> <div style="background-color: #2c2c2c; color: #fff; padding: 10px;">';
        var_dump($data);
        echo '</div></pre>';
        die();
    }
}