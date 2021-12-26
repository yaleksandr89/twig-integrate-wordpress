<?php

namespace FunctionsModules\Twig\Extension;

use FunctionsModules\ThemeOptions;
use FunctionsModules\Utils\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WpGetSidebarExtension extends AbstractExtension
{
    use Filesystem;

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_sidebar', [$this, 'getSidebar'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
                'needs_context'     => true
            ]),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'get_sidebar';
    }

    /**
     * @param Environment $environment
     * @param array $context
     * @param string|null $name
     *
     * @return void
     * @throws LoaderError
     */
    public function getSidebar(Environment $environment, array $context, ?string $name = null): void
    {
        /** @var ThemeOptions $themeOptions */
        $themeOptions = $context['app']['themeOptions'];

        $dirTemplates = $themeOptions->getParam('dirTemplates');
        $dirTemplate  = $dirTemplates . '/tpl-parts/';
        $tplName      = [];
        $this->createFolderIfNotExist([
            $dirTemplates,
            $dirTemplates . '/tpl-parts',
        ]);

        $templates = [];
        $name      = (string)$name;

        if ('' !== $name) {
            $templates[] = "{$dirTemplate}sidebar-{$name}.twig";
            $tplName[]   = "tpl-parts/sidebar-{$name}.twig";
        }

        $templates[] = "{$dirTemplate}sidebar.twig";
        $tplName[]   = 'tpl-parts/sidebar.twig';
        $this->createFileIfNotExist($dirTemplates . '/tpl-parts/sidebar.twig');

        $activeTemplates = current($templates);
        $activeTplName   = current($tplName);

        if (file_exists($activeTemplates)) {
            try {
                echo $environment->render($activeTplName);
            } catch (LoaderError|RuntimeError|SyntaxError $e) {
                throw new LoaderError($e->getMessage());
            }
        } else {
            try {
                echo $environment->render('tpl-parts/sidebar.twig');
            } catch (LoaderError|RuntimeError|SyntaxError $e) {
                throw new LoaderError($e->getMessage());
            }
        }
    }
}
