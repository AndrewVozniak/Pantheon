<?php

namespace App\Pantheon\Helpers;

/**
 * EnvHelper class
 */
class EnvHelper
{
    /** Get env key
     * @param string $key
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        $envFile = $_SERVER['DOCUMENT_ROOT'] . '/.env';

        if(!file_exists(filename: $envFile)) {
            throw new \InvalidArgumentException('File .env not found');
        }

        $envContent = file_get_contents(filename: $envFile);

        $lines = explode(separator: "\n", string: $envContent); // explode string by "\n" (new line) and get array of lines

        foreach ($lines as $line) {
            $parts = explode(separator: '=', string: $line); // explode string by "="
            $envKey = trim(string: $parts[0]); // get key

            if ($envKey === $key) {
                return trim(string: $parts[1]);
            }
        }

        return null;
    }

    /** Set env key
     * @param $key
     * @param $value
     * @return string|null
     */
    public static function set($key, $value): ?string
    {
        $envFile = $_SERVER['DOCUMENT_ROOT'] . '/.env';

        if(!file_exists(filename: $envFile)) {
            throw new \InvalidArgumentException('File .env not found');
        }

        $envContent = file_get_contents(filename: $envFile);

        $lines = explode(separator: "\n", string: $envContent); // explode string by "\n" (new line) and get array of lines

        foreach ($lines as $line) {
            $parts = explode(separator: '=', string: $line); // explode string by "="
            $envKey = trim(string: $parts[0]); // get key

            if ($envKey === $key) {
                $envContent = str_replace(search: $line, replace: $key . '=' . $value, subject: $envContent);
                file_put_contents(filename: $envFile, data: $envContent);

                return $value;
            }
        }

        return null;
    }
}