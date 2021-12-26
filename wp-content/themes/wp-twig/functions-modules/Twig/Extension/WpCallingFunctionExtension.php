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
     * @param mixed ...$args
     *
     * @return mixed
     */
    public function callingWordpressFunction(string $nameWpFunction, ...$args): mixed
    {
        if (function_exists( $nameWpFunction)){
            if (count($args) > 0) {

                if (is_array($args[0])){
                    return $nameWpFunction(current($args));
                }

                $result = implode(',', $args);

                return $nameWpFunction($result);
            }

            return $nameWpFunction();
        }

        return 'Функция не найдена!';
    }
}
