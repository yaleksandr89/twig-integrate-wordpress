<?php

require_once 'vendor/autoload.php';

use FunctionsModules\ChangingTemplatePath;
use FunctionsModules\Twig\TwigController;

try {
    /**
     * 1. Изменение путей подключаемых шаблонов
     * 2. Подключение и настройка Twig, а так же его интеграция с Symfony Var Dumper
     */
    new ChangingTemplatePath(); // 1
    new TwigController(); // 2
} catch (Throwable|Error $throwable) {
    echo $throwable->getMessage();
}
