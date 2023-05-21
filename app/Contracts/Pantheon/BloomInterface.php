<?php

namespace App\Contracts\Pantheon;

/**
 * Interface BloomInterface
 */
interface BloomInterface
{
    /**
     * @param string $name
     * @param array $data
     * @return mixed
     */
    public function render(string $name, array $data = []): mixed;

    /**
     * @param string $content
     * @return mixed
     */
    public function parse(string $content);
}