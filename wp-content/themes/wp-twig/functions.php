<?php

require_once 'vendor/autoload.php';

use FunctionsModules\ChangingTemplatePath;
use FunctionsModules\Twig\TwigController;


/*
|--------------------------------------------------------------------------
| Функционал темы:
| 1. ChangingTemplatePath     - Изменение путей подключаемых шаблонов
| 2. TwigController           - Подключение и настройка Twig, а так же его интеграция с Symfony Var Dumper
| 3. widgets                  - Подключение скриптов и стилей
|--------------------------------------------------------------------------
*/
new ChangingTemplatePath();
new TwigController();
include_once __DIR__ . '/functions-modules/Utils/Helper/styles-scripts.php';

add_theme_support( 'title-tag' );