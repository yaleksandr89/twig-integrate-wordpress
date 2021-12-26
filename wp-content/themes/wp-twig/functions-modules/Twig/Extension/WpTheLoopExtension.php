<?php

namespace FunctionsModules\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WpTheLoopExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('wp_the_loop', [$this, 'wpTheLoop']),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'wp_the_loop';
    }

    /**
     * @return array
     */
    public function wpTheLoop(): array
    {
        $result = [];

        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $result[] = get_post();
            }
        }

        return $result;
    }
}
