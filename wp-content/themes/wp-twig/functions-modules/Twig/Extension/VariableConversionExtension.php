<?php

namespace FunctionsModules\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class VariableConversionExtension extends AbstractExtension
{
    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('to_int', [$this, 'toInt']),
            new TwigFilter('to_string', [$this, 'toString']),
            new TwigFilter('to_bool', [$this, 'toBool']),
        ];
    }

    /**
     * @param mixed $var
     *
     * @return mixed
     */
    public function toInt(mixed $var): int
    {
        return (int)$var;
    }

    /**
     * @param mixed $var
     *
     * @return mixed
     */
    public function toString(mixed $var): int
    {
        return (string)$var;
    }

    /**
     * @param mixed $var
     *
     * @return mixed
     */
    public function toBool(mixed $var): int
    {
        return (bool)$var;
    }
}
