<?php

namespace FunctionsModules;

class ThemeOptions
{
    /**
     * @param string $feature
     * @param array $formats
     *
     * @return void
     */
    public function addThemeSupport(string $feature, array $formats = []): void
    {
        add_action('after_setup_theme', static function () use ($feature, $formats) {
            if (count($formats) > 0) {
                add_theme_support($feature, $formats);
            } else {
                add_theme_support($feature);
            }
        });
    }

    /**
     * @param array $pathToCss
     *
     * @return void
     */
    public function connectCss(array $pathToCss): void
    {
        add_action('wp_enqueue_scripts', static function () use ($pathToCss) {
            foreach ($pathToCss as $css) {
                $handleName = preg_replace('/\..+/', '', $css);
                wp_enqueue_style($handleName, (WP_TWIG_URL_CSS . '/' . $css), [], WP_TWIG_THEME_VERSION);
            }
        });
    }

    /**
     * @param array $pathToJs
     *
     * @return void
     */
    public function connectJs(array $pathToJs): void
    {
        add_action('wp_enqueue_scripts', static function () use ($pathToJs) {
            foreach ($pathToJs as $js) {
                $handleName = preg_replace('/\..+/', '', $js);
                wp_enqueue_script($handleName, (WP_TWIG_URL_CSS . '/' . $js), [], WP_TWIG_THEME_VERSION);
            }
        });
    }
}