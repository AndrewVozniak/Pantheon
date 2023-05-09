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
        return preg_replace('/\{\{(.+?)}}/', '<?php echo htmlentities($1) ?>', $content);
    }

    /**
     * @param $content
     * @return array|string
     */
    protected function parseConditionals($content): array|string
    {
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if ($1): ?>', $content);
        $content = preg_replace('/@elseif\s*\((.+?)\)/', '<?php elseif ($1): ?>', $content);
        $content = str_replace('@else', '<?php else: ?>', $content);
        return str_replace('@endif', '<?php endif; ?>', $content);
    }
}