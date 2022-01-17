<?php

namespace FunctionsModules;

class ThemeOptions
{
    /** @var string */
    private string $dirPath;

    /** @var string */
    private string $dirCss;

    /** @var string */
    private string $urlCss;

    /** @var string */
    private string $diJs;

    /** @var string */
    private string $urlJs;

    /** @var string */
    private string $diImg;

    /** @var string */
    private string $urlImg;

    /** @var string */
    private string $diFont;

    /** @var string */
    private string $urlFont;

    /** @var string */
    private string $diFile;

    /** @var string */
    private string $urlFile;

    /** @var string */
    private string $diNodeModules;

    /** @var string */
    private string $dirPlugins;

    /** @var string */
    private string $dirNameTemplates = 'templates';

    /** @var string */
    private string $dirTemplates;

    /** @var string */
    private string $themeVersion = '1.0.0';

    /** @var string */
    private string $themePrefix = 'WP_TWIG_';

    public function __construct()
    {
        $this->dirPath       = get_template_directory();
        $this->dirCss        = get_template_directory() . '/resources/css';
        $this->urlCss        = get_template_directory_uri() . '/resources/css';
        $this->diJs          = get_template_directory() . '/resources/js';
        $this->urlJs         = get_template_directory_uri() . '/resources/js';
        $this->diImg         = get_template_directory() . '/resources/images';
        $this->urlImg        = get_template_directory_uri() . '/resources/images';
        $this->diFont        = get_template_directory() . '/resources/fonts';
        $this->urlFont       = get_template_directory_uri() . '/resources/fonts';
        $this->diFile        = get_template_directory() . '/resources/files';
        $this->urlFile       = get_template_directory_uri() . '/resources/files';
        $this->diNodeModules = get_template_directory_uri() . '/resources/node_modules';
        $this->dirPlugins    = get_template_directory_uri() . '/resources/plugins';
        $this->dirTemplates  = get_template_directory() . '/templates';
    }

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
        $urlCss       = $this->getParam('urlCss');
        $themeVersion = $this->getParam('themeVersion');

        add_action('wp_enqueue_scripts', static function () use ($pathToCss, $urlCss, $themeVersion) {
            foreach ($pathToCss as $css) {
                $handleName = preg_replace('/\..+/', '', $css);
                wp_enqueue_style($handleName, ($urlCss . '/' . $css), [], $themeVersion);
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
        $urlJs        = $this->getParam('urlJs');
        $themeVersion = $this->getParam('themeVersion');

        add_action('wp_enqueue_scripts', static function () use ($pathToJs, $urlJs, $themeVersion) {
            foreach ($pathToJs as $js) {
                $handleName = preg_replace('/\..+/', '', $js);
                wp_enqueue_script($handleName, ($urlJs . '/' . $js), [], $themeVersion);
            }
        });
    }

    /**
     * @return string
     */
    public function get_theme_version(): string
    {
        return $this->themeVersion;
    }

    /**
     * @param string $themeVersion
     */
    public function set_theme_version(string $themeVersion): void
    {
        $this->themeVersion = $themeVersion;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'dirPath'       => $this->dirPath,
            'dirCss'        => $this->dirCss,
            'urlCss'        => $this->urlCss,
            'diJs'          => $this->diJs,
            'urlJs'         => $this->urlJs,
            'diImg'         => $this->diImg,
            'urlImg'        => $this->urlImg,
            'diFont'        => $this->diFont,
            'urlFont'       => $this->urlFont,
            'diFile'        => $this->diFile,
            'urlFile'       => $this->urlFile,
            'diNodeModules' => $this->diNodeModules,
            'dirPlugins'    => $this->dirPlugins,
            'dirTemplates'  => $this->dirTemplates,
        ];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getParam(string $name): string
    {
        return $this->$name;
    }

    /**
     * @param array $directives
     * @param bool $clearDefaultDirective
     *
     * @return void
     */
    public function addedDirectivesToRobotsTxt(array $directives, bool $clearDefaultDirective = false): void
    {
        // -1 before wp-sitemap.xml
        add_action('robots_txt', function ($output) use ($directives, $clearDefaultDirective) {

            if ($clearDefaultDirective) {
                $output = '';
            }else {
                $output .= "\n";
            }

            foreach ($directives as $directive) {
                $directive = trim($directive);
                $directive = preg_replace( '/^[\t ]+(?!#)/mU', '', $directive );
                $output .= $directive . "\n";
            }

            return $output;
        }, -1);
    }
}