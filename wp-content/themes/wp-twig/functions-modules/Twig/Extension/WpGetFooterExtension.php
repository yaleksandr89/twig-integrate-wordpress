<?php

namespace FunctionsModules\Twig\Extension;

use FunctionsModules\Utils\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WpGetFooterExtension extends AbstractExtension
{
    use Filesystem;

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_footer', [$this, 'getFooter'], [
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
        return 'get_footer';
    }

    /**
     * @param Environment $environment
     * @param string|null $name
     *
     * @return void
     * @throws LoaderError
     */
    public function getFooter(Environment $environment, ?string $name = null): void
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
            $templates[] = "{$dirTemplate}footer-{$name}.twig";
            $tplName[]   = "tpl-parts/footer-{$name}.twig";
        }

        $templates[] = "{$dirTemplate}footer.twig";
        $tplName[]   = 'tpl-parts/footer.twig';
        $this->createFileIfNotExist($dirTemplates . '/tpl-parts/footer.twig');

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
                echo $environment->render('tpl-parts/footer.twig');
            } catch (LoaderError|RuntimeError|SyntaxError $e) {
                throw new LoaderError($e->getMessage());
            }
        }
    }
}
