<?php

namespace App\Contracts\Pantheon;

interface BloomInterface
{
    public function render(string $name, array $data = []);

    public function parse(string $content);
}