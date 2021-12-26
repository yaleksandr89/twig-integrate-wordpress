<?php

require_once 'vendor/autoload.php';

use FunctionsModules\ChangingTemplatePath;
use FunctionsModules\ThemeOptions;
use FunctionsModules\Twig\TwigController;


/*
|--------------------------------------
| Изменение путей подключаемых шаблонов
|--------------------------------------
*/
new ChangingTemplatePath();

/*
|---------------------------------------------------------------------------
| Подключение и настройка Twig, а так же его интеграция с Symfony Var Dumper
|---------------------------------------------------------------------------
*/
new TwigController();
$themeOptions = new ThemeOptions();
$themeOptions->addThemeSupport('title-tag');
$themeOptions->addThemeSupport('post-thumbnails');
$themeOptions->addThemeSupport('html5',[
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
    'script',
    'style',
]);
$themeOptions->connectCss([
    'style.css'
]);
