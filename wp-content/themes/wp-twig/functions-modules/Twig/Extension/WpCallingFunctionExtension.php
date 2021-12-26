<?php

namespace FunctionsModules\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WpCallingFunctionExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('wp_call_func', [$this, 'callingWordpressFunction']),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'wp_call_func';
    }

    /**
     * @param string $nameWpFunction
     * @param string $arg
     *
     * @return mixed
     */
    public function callingWordpressFunction(string $nameWpFunction, string $arg = ''): mixed
    {
        if (function_exists( $nameWpFunction)){
            if ('' !== $arg) {
                return $nameWpFunction($arg);
            }

            return $nameWpFunction();
        }

        return 'Функция не найдена!';
    }
}
