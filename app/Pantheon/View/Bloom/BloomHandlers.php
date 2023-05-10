<?php

namespace App\Pantheon\View\Bloom;

/** Bloom template engine handlers
 *
 */
class BloomHandlers
{
    /**
     * @param $content
     * @return array|string|null
     */

    protected function parseEcho($content): array|string|null
    {
        return preg_replace(pattern: '/\{\{(.+?)}}/', replacement: '<?php echo htmlentities($1) ?>', subject: $content);
    }

    /**
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
     * @directive @include
     * @param $content
     * @return array|string
     */
    protected function parseInclude($content): array|string
    {
        return preg_replace(pattern: "/{$this->bloomSymbol}include\\s*\\((.+?)\\)/", replacement: '<?php include "$this->includesPath/$1.bloom.php"; ?>', subject: $content);
    }

    /**
     * @param $content
     * @return array|string
     */
    protected function parseComponent($content): array|string
    {
        return preg_replace_callback("/{$this->bloomSymbol}component\\s*\\((.+?)\\)/", function($matches) {
            $componentPath = "{$this->componentsPath}/{$matches[1]}.bloom.php";

            if (!file_exists($componentPath)) {
                throw new \Exception("Component [{$matches[1]}] not found at path: {$componentPath}");
            }

            $componentContent = file_get_contents($componentPath);

            return $componentContent;
        }, $content);
    }


    /**
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
     * @param $content
     * @return array|string
     */
    protected function parseEmpty($content): array|string
    {
        $content = preg_replace(pattern: "/{$this->bloomSymbol}empty\\s*\\((.+?)\\)/", replacement: '<?php if (empty($1)): ?>', subject: $content);
        $content = str_replace(search: $this->bloomSymbol . 'endempty', replace: '<?php endif; ?>', subject: $content);

        return $content;
    }

    // @component(string name, array props)
//    protected function parseComponent($content)
//    {
/*        return preg_replace(pattern: "/{$this->bloomSymbol}component\\s*\\((.+?)\\)/", replacement: '<?php include "{$this->componentsPath}/$1.bloom.php"; ?>', subject: $content);*/
//    }
}