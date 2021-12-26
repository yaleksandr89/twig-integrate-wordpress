<?php

namespace FunctionsModules\Twig;

use FunctionsModules\Twig\StaticStorage\WpGlobalVariableStaticStorage;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TwigController extends BaseTwigController
{
    /** @var string */
    private string $pathToTemplate = '/templates/';

    public function __construct()
    {
        parent::__construct([get_template_directory() . $this->pathToTemplate]);
        add_filter('template_include', [$this, 'template_include']);
    }

    /**
     * @param string $template
     *
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function template_include(string $template): void
    {
        $tplFolder    = 'tpl-system/';
        $tplExtension = '.twig';

        preg_match('/\/templates\/(.*)/', $template, $findTemplate);
        preg_match('/template-canvas.php/', $template, $templateNotFound);

        if ('template-canvas.php' === array_pop($templateNotFound)) {
            $pathToSystemTemplate = WP_TWIG_DIR_PATH . $this->pathToTemplate . $tplFolder;
            $this->creatingTemplateIfNotExist($pathToSystemTemplate, $tplFolder, $tplExtension);
        } else {
            $tplName = str_replace($tplExtension, '', $findTemplate[1]);
            $this->render($tplName, $this->getWpGlobalVariable());
        }
    }

    /**
     * @param array $params
     *
     * @return void
     */
    private function initializationTemplate(array $params): void
    {
        $this->createFileIfNotExist($params['pathToSystemTemplate'] . $params['templateName'] . $params['tplExtension'], $params['templateName']);
        try {
            $this->render($params['tplFolder'] . $params['templateName'], $this->getWpGlobalVariable());
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $pathToSystemTemplate
     * @param string $tplFolder
     * @param string $tplExtension
     *
     * @return void
     */
    private function creatingTemplateIfNotExist(string $pathToSystemTemplate, string $tplFolder, string $tplExtension): void
    {
        switch (true) {
            case is_front_page():
                $this->initializationTemplate([
                    'templateName'         => 'front-page',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_home():
                $this->initializationTemplate([
                    'templateName'         => 'home',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_page():
                $this->initializationTemplate([
                    'templateName'         => 'page',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_singular():
                $this->initializationTemplate([
                    'templateName'         => 'single',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_404():
                $this->initializationTemplate([
                    'templateName'         => '404',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_search():
                $this->initializationTemplate([
                    'templateName'         => 'search',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_archive():
                $this->initializationTemplate([
                    'templateName'         => 'archive',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            case is_embed():
                $this->initializationTemplate([
                    'templateName'         => 'embed',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
                break;
            default:
                $this->initializationTemplate([
                    'templateName'         => 'index',
                    'pathToSystemTemplate' => $pathToSystemTemplate,
                    'tplFolder'            => $tplFolder,
                    'tplExtension'         => $tplExtension,

                ]);
        }
    }

    /**
     * @return array
     */
    private function getWpGlobalVariable(): array
    {
        $wpGlobalVariable['wordpress'] = [
            'versionVariables'   => WpGlobalVariableStaticStorage::getVersionVariables(),
            'checkingBrowsers'   => WpGlobalVariableStaticStorage::getCheckingBrowsers(),
            'webServerVariables' => WpGlobalVariableStaticStorage::getWebServerVariables(),
        ];


        if ($post = WpGlobalVariableStaticStorage::getWpPost()) {
            $wpGlobalVariable['wordpress']['WP_POST'] = $post;
        }

        return $wpGlobalVariable;
    }
}
