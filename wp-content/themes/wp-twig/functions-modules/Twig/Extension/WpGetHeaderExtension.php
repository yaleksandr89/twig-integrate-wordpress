<?php

namespace FunctionsModules\Twig\Extension;

use FunctionsModules\Utils\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WpGetHeaderExtension extends AbstractExtension
{
    use Filesystem;

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_header', [$this, 'getHeader'], [
                'needs_environment' => true,
                'is_safe'           => ['html']
            ]),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'get_header';
    }

    /**
     * @param Environment $environment
     * @param string|null $name
     *
     * @return void
     * @throws LoaderError
     */
    public function getHeader(Environment $environment, ?string $name = null): void
    {
        $dirTemplates = WP_TWIG_DIR_TEMPLATE;
        $dirTemplate  = $dirTemplates . '/tpl-parts/';
        $tplName      = [];
        $this->createFolderIfNotExist([
            $dirTemplates,
            $dirTemplates . '/tpl-parts',
        ]);

        $templates = [];
        $name      = (string)$name;

        if ('' !== $name) {
            $templates[] = "{$dirTemplate}{$name}.twig";
            $tplName[]   = "tpl-parts/{$name}.twig";
        }

        $templates[] = "{$dirTemplate}header.twig";
        $tplName[]   = 'tpl-parts/header.twig';
        $this->createFileIfNotExist($dirTemplates . '/tpl-parts/header.twig');

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
                echo $environment->render('tpl-parts/header.twig');
            } catch (LoaderError|RuntimeError|SyntaxError $e) {
                throw new LoaderError($e->getMessage());
            }
        }
    }
}
