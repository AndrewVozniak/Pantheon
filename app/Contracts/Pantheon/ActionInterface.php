<?php

namespace App\Contracts\Pantheon;

/**
 * Interface ActionInterface
 */
interface ActionInterface
{
    /**
     * @return mixed
     */
    public function run(): mixed;
}