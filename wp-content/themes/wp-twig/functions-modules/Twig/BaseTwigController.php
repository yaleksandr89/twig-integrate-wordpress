<?php

namespace FunctionsModules\Twig;

use FunctionsModules\Twig\Extension\SymfonyDebugExtension;
use FunctionsModules\Twig\Extension\WordPressActionExtension;
use FunctionsModules\Twig\Extension\WordPressFilterExtension;
use FunctionsModules\Utils\Filesystem;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

abstract class BaseTwigController
{
    use Filesystem;

    /** @var Environment */
    protected Environment $environment;

    /**
     * @param array $directories
     */
    public function __construct(array $directories)
    {
        $this->createFolderIfNotExist($directories); // Проверка существования директорий и в случае отсутствия - создание

        $loader = new FilesystemLoader($directories);
        $this->environment = new Environment($loader, [
            'debug' => true,
            'cache' => false,
        ]);

        $this->environment->addExtension(new SymfonyDebugExtension(new VarCloner(), new HtmlDumper())); // Подключение Symfony VarDumper
        $this->environment->addExtension(new WordPressActionExtension()); // Подключение WP action
        $this->environment->addExtension(new WordPressFilterExtension()); // Подключение WP filter
        $this->environment->addGlobal('app', [
            'get' => $_GET,
            'post' => $_POST,
            'cookie' => $_COOKIE,
            'session' => $_SESSION ?? null,
        ]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render(string $template, array $params): void
    {
        echo $this->environment->render($template . '.twig', $params);
    }
}