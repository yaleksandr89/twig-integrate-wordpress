<?php

require_once 'vendor/autoload.php';

use FunctionsModules\ChangingTemplatePath;
use FunctionsModules\ThemeOptions;
use FunctionsModules\Twig\TwigController;

/*
|---------------------------------------------------------------------------
| Подключение и настройка Twig, а так же его интеграция с Symfony Var Dumper
|---------------------------------------------------------------------------
*/
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

/*
|--------------------------------------
| Изменение путей подключаемых шаблонов
|--------------------------------------
*/
new ChangingTemplatePath($themeOptions);

/*
|---------------------------------------------------------------------------
| Инициализация Twig
|---------------------------------------------------------------------------
*/
new TwigController($themeOptions);
