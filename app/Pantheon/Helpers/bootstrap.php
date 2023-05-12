<?php

/**
 * @param $data
 * @return void
 */
function dd($data): void
{
    \App\Pantheon\Helpers\TextHelper::dd($data);
}

/** Get or set env value
 * @param $key
 * @param $default
 * @return bool|string|null
 */
function env($key, $default = null): bool|string|null
{
    if(!empty($default)): return \App\Pantheon\Helpers\EnvHelper::set($key, $default); // if env has second argument, then set value
    else: return \App\Pantheon\Helpers\EnvHelper::get($key, $default); // else get value
    endif;
}

/**
 * @param string $name
 * @param array $data
 * @return void
 * @throws Exception
 */
function render(string $name, array $data): void
{
    \App\Pantheon\Bloom\View::render($name, $data);
}