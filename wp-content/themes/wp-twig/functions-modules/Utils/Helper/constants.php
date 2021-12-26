<?php

// Версия
const WP_TWIG_THEME_VERSION = '1.0.0';

// Префикс темы
const WP_TWIG_THEME_PREFIX = 'WP_TWIG_';

// PATH до темы
define('WP_TWIG_DIR_PATH', get_template_directory());
// URL до темы
define('WP_TWIG_URL_PATH', get_template_directory_uri());

// PATH до CSS
define('WP_TWIG_DIR_CSS', get_template_directory() . '/resources/css');
// URL до CSS
define('WP_TWIG_URL_CSS', get_template_directory_uri() . '/resources/css');

// PATH до JS
define('WP_TWIG_DIR_JS', get_template_directory() . '/resources/js');
// URL до JS
define('WP_TWIG_URL_JS', get_template_directory_uri() . '/resources/js');

// PATH до Images
define('WP_TWIG_DIR_iMAGES', get_template_directory() . '/resources/images');
// URL до Images
define('WP_TWIG_URL_iMAGES', get_template_directory_uri() . '/resources/images');

// PATH до Fonts
define('WP_TWIG_DIR_FONTS', get_template_directory() . '/resources/fonts');
// URL до Fonts
define('WP_TWIG_URL_FONTS', get_template_directory_uri() . '/resources/fonts');

// PATH до Files
define('WP_TWIG_DIR_FILES', get_template_directory() . '/resources/files');
// URL до Files
define('WP_TWIG_URL_FILES', get_template_directory_uri() . '/resources/files');

// PATH до NODE_MODULES
define('WP_TWIG_DIR_NODE_MODULES', get_template_directory() . '/node_modules');

// PATH до плагинов
define('WP_TWIG_DIR_PLUGINS', get_template_directory() . '/resources/plugins');

// PATH до NODE_MODULES
define('WP_TWIG_DIR_TEMPLATE', get_template_directory() . '/templates');

/**
 * Значение возвращается, если не удалось вернуть на стройку темы.
 * @url https://wp-kama.ru/function/get_theme_mod
 */
const WP_TWIG_GET_THE_MOD_DEFAULT = 'Значение поля не установлено';

/**
 * Параметры отображения предварительного просмотра изменений в Настройщике тем.
 * @url https://wp-kama.ru/handbook/theme/customize-api
 * 'refresh' - перезагрузкой фрейма (можно полностью отказаться от JavaScript)
 * 'postMessage' - отправкой AJAX запроса
 */
const WP_TWIG_CUSTOMIZER_TRANSPORT_REFRESH      = 'refresh';
const WP_TWIG_CUSTOMIZER_TRANSPORT_POST_MESSAGE = 'postMessage';

function getConstants(): array
{
    return [
        'WP_TWIG_THEME_VERSION'    => WP_TWIG_THEME_VERSION,
        'WP_TWIG_THEME_PREFIX'     => WP_TWIG_THEME_PREFIX,
        'WP_TWIG_DIR_PATH'         => WP_TWIG_DIR_PATH,
        'WP_TWIG_URL_PATH'         => WP_TWIG_URL_PATH,
        'WP_TWIG_DIR_CSS'          => WP_TWIG_DIR_CSS,
        'WP_TWIG_URL_CSS'          => WP_TWIG_URL_CSS,
        'WP_TWIG_DIR_JS'           => WP_TWIG_DIR_JS,
        'WP_TWIG_URL_JS'           => WP_TWIG_URL_JS,
        'WP_TWIG_DIR_iMAGES'       => WP_TWIG_DIR_iMAGES,
        'WP_TWIG_URL_iMAGES'       => WP_TWIG_URL_iMAGES,
        'WP_TWIG_DIR_FONTS'        => WP_TWIG_DIR_FONTS,
        'WP_TWIG_URL_FONTS'        => WP_TWIG_URL_FONTS,
        'WP_TWIG_DIR_FILES'        => WP_TWIG_DIR_FILES,
        'WP_TWIG_URL_FILES'        => WP_TWIG_URL_FILES,
        'WP_TWIG_DIR_NODE_MODULES' => WP_TWIG_DIR_NODE_MODULES,
        'WP_TWIG_DIR_PLUGINS'      => WP_TWIG_DIR_PLUGINS,
        'WP_TWIG_DIR_TEMPLATE'     => WP_TWIG_DIR_TEMPLATE,
    ];
}

function getConstant(string $name): string
{
    return constant($name);
}
