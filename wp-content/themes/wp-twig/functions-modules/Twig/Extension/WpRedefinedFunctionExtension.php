<?php

namespace FunctionsModules\Twig\Extension;

use FunctionsModules\Utils\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WpRedefinedFunctionExtension extends AbstractExtension
{
    use Filesystem;

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('wp_parse_str', [$this, 'parseStr']),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'wp_parse_str';
    }

    /**
     * @param string $queryString
     *
     * @return array
     */
    public function parseStr(string $queryString = ''): array
    {
       $args = [];

       if ('' !== $queryString) {
           parse_str($queryString, $args);
       }

       return $args;
    }
}
