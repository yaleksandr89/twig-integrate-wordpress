<?php

add_action('wp_enqueue_scripts', static function () {
    // CSS
    wp_enqueue_style('style', (WP_TWIG_URL_CSS . '/style.css'), [], WP_TWIG_THEME_VERSION);
});