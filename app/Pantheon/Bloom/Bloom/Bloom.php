<?php

namespace App\Pantheon\Bloom\Bloom;

use App\Contracts\Pantheon\BloomInterface;
use Exception;

/** Bloom template engine
 *
 */
class Bloom extends BloomHandlers implements BloomInterface
{
    protected string $viewPath;
    public string $bloomSymbol;
    public string $layoutsPath;
    public string $componentsPath;
    protected string $includesPath;

    public function __construct()
    {
        $this->viewPath = 'resources/views';
        $this->bloomSymbol = '@';
        $this->componentsPath = 'resources/views/components';
        $this->layoutsPath = 'resources/views/layouts';
        $this->includesPath = 'resources/views/includes';
    }

    /**
     * @param string $name
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function render(string $name, array $data = []): string
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

    /**
     * @throws Exception
     */
    public function parse($content)
    {
        header('Content-Type: text/html; charset=UTF-8');
        $content = parent::parseLayout($content); // @extends, @section, @endsection, @parent

        $content = parent::parseInclude($content); // @include || include static element
        $content = parent::parseComponent($content); // @component || include dynamic elements, in components you can use directives
        $content = parent::parseEcho($content); // {{ }} || echo variable
        $content = parent::parseConditionals($content); // @if, @elseif, @else, @endif
        $content = parent::parseForeach($content); // @foreach, @endforeach
        $content = parent::parseFor($content); // @for, @endfor
        $content = parent::parseIsset($content); // @isset @endisset
        $content = parent::parseEmpty($content); // @empty @endempty
        $content = parent::parseRoute($content); // @route('name')
        $content = parent::parseAlert($content); // @alert('string')


        return $content;
    }

}

