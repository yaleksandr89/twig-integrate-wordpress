<?php

namespace FunctionsModules;

use FunctionsModules\Utils\Filesystem;

class ChangingTemplatePath
{
    use Filesystem;

    public function __construct()
    {
        add_filter('index' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('404' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('archive' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('author' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('category' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('tag' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('taxonomy' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('date' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('embed' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('home' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('frontpage' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('privacypolicy' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('page' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('paged' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('search' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('single' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('singular' . '_template_hierarchy', [$this, 'changingTemplatePath']);
        add_filter('attachment' . '_template_hierarchy', [$this, 'changingTemplatePath']);
    }

    /**
     * @param array $template
     *
     * @return array
     */
    public function changingTemplatePath(array $template): array
    {
        return array_map(function ($el) {
            $pathSysToTemplate    = '/templates/tpl-system/';
            $pathCustomToTemplate = '/templates/tpl-custom/';

            // Проверка существования директорий и в случае отсутствия - создание
            $this->createFolderIfNotExist([
                WP_TWIG_DIR_PATH . $pathSysToTemplate,
                WP_TWIG_DIR_PATH . $pathCustomToTemplate,
            ]);

            $element = $this->changingExtensionTemplate($el, 'twig');

            if ('front-page.twig' !== $element && str_contains($element, '-')) {
                return $pathCustomToTemplate . $element;
            }

            return $pathSysToTemplate . $element;
        }, $template);
    }

    /**
     * @param string $pathToTemplate
     * @param string $fileExtension
     *
     * @return string
     */
    private function changingExtensionTemplate(string $pathToTemplate, string $fileExtension = 'php'): string
    {
        $result = explode('.', $pathToTemplate);
        array_pop($result);
        $result[] = $fileExtension;

        return implode('.', $result);
    }
}