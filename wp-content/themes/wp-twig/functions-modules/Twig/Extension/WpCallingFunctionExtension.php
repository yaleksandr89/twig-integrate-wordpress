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
            new TwigFunction('call_wp_func', [$this, 'callingWordpressFunction']),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'call_wp_func';
    }

    public function callingWordpressFunction(string $nameWpFunction, $arg = ''): void
    {

        if (function_exists( $nameWpFunction)){
            if ('' !== $arg) {
                $nameWpFunction($arg);
            } else {
                $nameWpFunction();
            }
        } else {
            echo 'Функция не найдена!';
        }
    }
}
