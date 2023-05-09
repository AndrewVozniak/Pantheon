<?php

namespace App\Pantheon\View\Bloom;

/** Bloom template engine handlers
 *
 */
class BloomHandlers
{
    public string $bloomSymbol = '@';

    /**
     * @param $content
     * @return array|string|null
     */

    protected function parseEcho($content): array|string|null
    {
        return preg_replace('/\{\{(.+?)}}/', '<?php echo htmlentities($1) ?>', $content);
    }

    /**
     * @param $content
     * @return array|string
     */
    protected function parseConditionals($content): array|string
    {
        $content = preg_replace('/'. $this->bloomSymbol . 'if\s*\((.+?)\)/', '<?php if ($1): ?>', $content);
        $content = preg_replace('/'. $this->bloomSymbol . 'elseif\s*\((.+?)\)/', '<?php elseif ($1): ?>', $content);
        $content = str_replace($this->bloomSymbol . 'else', '<?php else: ?>', $content);
        return str_replace($this->bloomSymbol . 'endif', '<?php endif; ?>', $content);
    }

    protected function parseForeach($content): array|string
    {
        $content = preg_replace('/'. $this->bloomSymbol . 'foreach\s*\((.+?)\)/', '<?php foreach ($1): ?>', $content);
        $content = str_replace($this->bloomSymbol . 'endforeach', '<?php endforeach; ?>', $content);
        return $content;
    }
}