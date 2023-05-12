<?php

namespace App\Pantheon\View\Bloom;

use App\Pantheon\Router\Router;
use Exception;

/** Bloom template engine handlers
 *
 */
class BloomHandlers
{
    /**
     * @directive {{ $var }}
     * @param $content
     * @return array|string|null
     */
    protected function parseEcho($content): array|string|null
    {
        return preg_replace(pattern: '/\{\{(.+?)}}/', replacement: '<?php echo htmlentities($1) ?>', subject: $content);
    }

    /**
     * @directive @if, @elseif, @else, @endif
     * @param $content
     * @return array|string
     */
    protected function parseConditionals($content): array|string
    {
        $content = preg_replace(pattern: "/{$this->bloomSymbol}if\\s*\\((.+?)\\)/", replacement: '<?php if ($1): ?>', subject: $content);
        $content = preg_replace(pattern: "/{$this->bloomSymbol}elseif\\s*\\((.+?)\\)/", replacement: '<?php elseif ($1): ?>', subject: $content);
        $content = str_replace(search: $this->bloomSymbol . 'else', replace: '<?php else: ?>', subject: $content);
        return str_replace(search: $this->bloomSymbol . 'endif', replace: '<?php endif; ?>', subject: $content);
    }

    /**
     * @directive @for, @endfor
     * @param $content
     * @return array|string
     */
    protected function parseFor($content): array|string
    {
        $content = preg_replace(pattern: "/{$this->bloomSymbol}for\\s*\\((.+?)\\)/", replacement: '<?php for ($1): ?>', subject: $content);
        $content = str_replace(search: $this->bloomSymbol . 'endfor', replace: '<?php endfor; ?>', subject: $content);

        return $content;
    }

    /**
     * @directive @foreach, @endforeach
     * @param $content
     * @return array|string
     */
    protected function parseForeach($content): array|string
    {
        $content = preg_replace(pattern: "/{$this->bloomSymbol}foreach\\s*\\((.+?)\\)/", replacement: '<?php foreach ($1): ?>', subject: $content);
        $content = str_replace(search: $this->bloomSymbol . 'endforeach', replace: '<?php endforeach; ?>', subject: $content);

        return $content;
    }


    /**
     * @directive @route
     * @usability @route(name) -> give link of route which name is 'name'. With params: @route(name, ['id' => 1]) -> give link of route which name is 'name' and set get params to ['id' => 1]
     * @param $content
     * @return array|string
     * @throws Exception
     */
    protected function parseRoute($content): array|string
    {
        return preg_replace_callback(pattern: "/{$this->bloomSymbol}route\\s*\\((.+?)\\)/", callback: function($matches) {
            $routeName = $matches[1];
            $routeParams = [];

            if (str_contains($routeName, ',')) {
                $routeName = explode(',', $routeName)[0];
                $routeParamsString = explode(',', $matches[1])[1];

                // Remove leading/trailing spaces and square brackets from $routeParamsString
                $routeParamsString = trim($routeParamsString, " []");

                // Explode $routeParamsString by ',' to separate key-value pairs
                $routeParamsPairs = explode(',', $routeParamsString);

                // Loop through the $routeParamsPairs and assign keys and values to $routeParams
                foreach ($routeParamsPairs as $pair) {
                    $pair = trim($pair);

                    // Explode each pair by '=>' to separate key and value
                    $pairArray = explode('=>', $pair);
                    if (count($pairArray) === 2) {
                        $key = trim($pairArray[0], " '");
                        $value = trim($pairArray[1], " '");
                        $routeParams[$key] = $value;
                    }
                }
            }

            $route = Router::getRouteByName($routeName);

            if (!$route) {
                throw new Exception(message: "Route [{$routeName}] not found");
            }

            $routeLink = $route->getLink();

            if (count($routeParams) > 0) {
                $routeLink .= '?';

                foreach ($routeParams as $key => $value) {
                    $routeLink .= "$key=$value&";
                }

                $routeLink = substr(string: $routeLink, offset: 0, length: -1);
            }

            return $routeLink;
        }, subject: $content);
    }

    /**
     * @directive @component
     * @param $content
     * @return array|string
     * @throws Exception
     */
    protected function parseComponent($content): array|string
    {
        return preg_replace_callback(pattern: "/{$this->bloomSymbol}component\\s*\\((.+?)\\)/", callback: function($matches) {
            $componentPath = "{$this->componentsPath}/{$matches[1]}.bloom.php";

            if (!file_exists($componentPath)) {
                throw new Exception(message: "Component [{$matches[1]}] not found at path: {$componentPath}");
            }

            return file_get_contents($componentPath);;
        }, subject: $content);
    }

    /**
     * @directive @include
     * @param $content
     * @return array|string
     * @throws Exception
     */
    protected function parseInclude($content): array|string
    {
        return preg_replace(pattern: "/{$this->bloomSymbol}include\\s*\\((.+?)\\)/", replacement: '<?php include "$this->includesPath/" . \'$1\' . ".bloom.php"; ?>', subject: $content);
    }

    /**
     * @directives: @layout, @section, @endsection, @slot
     * @param $content
     * @return array|false|string|null
     * @throws Exception
     */
    protected function parseLayout($content): array|false|string|null
    {
        // parse extends name and set value in $layoutName
        $content = preg_replace_callback(pattern: "/{$this->bloomSymbol}layout\\s*\\((.+?)\\)/", callback: function($matches) use (&$layoutName) {
            $layoutName = $matches[1];
            return '';
        }, subject: $content);

        // if layout name is not null parse parent content
        if ($layoutName) {
            // get layout path
            $layoutPath = "{$this->layoutsPath}/{$layoutName}.bloom.php";

            // check layout file exists
            if (!file_exists($layoutPath)) {
                throw new Exception(message: "Layout [{$layoutName}] not found at path: {$layoutPath}");
            }

            // get layout content
            $layoutContent = file_get_contents($layoutPath);

            // compare @yield and @section then replace @yield with @section content
            preg_match_all(pattern: "/{$this->bloomSymbol}section\((.*?)\)(.*?){$this->bloomSymbol}endsection/s", subject: $content, matches: $matches, flags: PREG_SET_ORDER);

            foreach ($matches as $match) {
                $layoutContent = str_replace(search: "{$this->bloomSymbol}slot($match[1])", replace: trim($match[2]), subject: $layoutContent);
            }

            return $layoutContent;
        }
        else {
            return $content;
        }
    }

    /**
     * @directive: @isset, @endisset
     * @param $content
     * @return array|string
     */
    protected function parseIsset($content): array|string
    {
        // if isset show content @isset($var) @endisset
        $content = preg_replace(pattern: "/{$this->bloomSymbol}isset\\s*\\((.+?)\\)/", replacement: '<?php if (isset($1)): ?>', subject: $content);
        $content = str_replace(search: $this->bloomSymbol . 'endisset', replace: '<?php endif; ?>', subject: $content);

        return $content;
    }

    /**
     * @directive: @empty, @endempty
     * @param $content
     * @return array|string
     */
    protected function parseEmpty($content): array|string
    {
        $content = preg_replace(pattern: "/{$this->bloomSymbol}empty\\s*\\((.+?)\\)/", replacement: '<?php if (empty($1)): ?>', subject: $content);
        $content = str_replace(search: $this->bloomSymbol . 'endempty', replace: '<?php endif; ?>', subject: $content);

        return $content;
    }
}