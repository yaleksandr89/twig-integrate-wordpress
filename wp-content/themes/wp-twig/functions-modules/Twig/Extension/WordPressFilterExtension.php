<?php

namespace FunctionsModules\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WordPressFilterExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('filter', [$this, 'wordpressFilter'], ['needs_context' => true]),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'filter';
    }

    public function wordpressFilter($context): void
    {
        $args = func_get_args();
        array_shift( $args );
        $args[] = $context;
        echo apply_filters(...$args);
    }
}
