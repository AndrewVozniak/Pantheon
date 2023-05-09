<?php

namespace App\Pantheon\View\Bloom;

use App\Contracts\Pantheon\BloomInterface;
use Exception;


/** Bloom template engine
 *
 */
class Bloom extends BloomHandlers implements BloomInterface
{
    public string $viewPath;

    public function __construct()
    {
        $this->viewPath = 'resources/views';
    }

    /**
     * @param string $name
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function render(string $name, array $data = [])
    {
        $viewPath = $this->viewPath . '/' . str_replace('.', '/', $name) . '.bloom.php';

        if (!file_exists($viewPath)) {
            throw new Exception("View [{$name}] not found at path: {$viewPath}");
        }

        $content = file_get_contents($viewPath);
        $content = $this->parse($content);

        extract($data);

        ob_start();
        eval('?>' . $content);
        return ob_get_clean();
    }

    public function parse($content)
    {
        $content = parent::parseEcho($content);
        $content = parent::parseConditionals($content);
        $content = parent::parseForeach($content);

        // Add additional parsing logic for other directives

        return $content;
    }

}

