<?php

namespace FunctionsModules\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WordPressActionExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('action', [$this, 'wordpressAction'], ['needs_context' => true]),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'action';
    }

    public function wordpressAction($context): void
    {
        $args = func_get_args();
        array_shift($args);
        $args[] = $context;
        do_action(...$args);
    }
}
