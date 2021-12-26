<?php

namespace FunctionsModules\Twig;

use FunctionsModules\Twig\Extension\ArrayExtension;
use FunctionsModules\Twig\Extension\IntlExtension;
use FunctionsModules\Twig\Extension\SymfonyDebugExtension;
use FunctionsModules\Twig\Extension\TextExtension;
use FunctionsModules\Twig\Extension\VariableConversionExtension;
use FunctionsModules\Twig\Extension\WpActionExtension;
use FunctionsModules\Twig\Extension\WpCallingFunctionExtension;
use FunctionsModules\Twig\Extension\WpFilterExtension;
use FunctionsModules\Twig\Extension\WpGetFooterExtension;
use FunctionsModules\Twig\Extension\WpGetHeaderExtension;
use FunctionsModules\Twig\Extension\WpGetSidebarExtension;
use FunctionsModules\Twig\Extension\WpRedefinedFunctionExtension;
use FunctionsModules\Twig\Extension\WpTheLoopExtension;
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
        $this->environment->addExtension(new IntlExtension()); // github: https://github.com/twigphp
        $this->environment->addExtension(new TextExtension()); // github: https://github.com/twigphp
        $this->environment->addExtension(new ArrayExtension()); // github: https://github.com/twigphp
        $this->environment->addExtension(new WpActionExtension()); // {% do action('robots_txt') %} / {{ action() }}
        $this->environment->addExtension(new WpFilterExtension()); // {% do filter('the_content', post.post_content ) %} / {{ filter('the_content', post.post_content ) }}
        $this->environment->addExtension(new WpGetHeaderExtension()); // {% do get_header() %} / {{ get_header() }}
        $this->environment->addExtension(new WpGetFooterExtension()); // {% do get_footer() %} / {{ get_footer() }}
        $this->environment->addExtension(new WpCallingFunctionExtension()); // {% do wp_call_func('name', 'arg') %} / {{ wp_call_func('name', 'arg') }}
        $this->environment->addExtension(new WpTheLoopExtension()); // {% do wp_the_loop() %} / {{ wp_the_loop() }}
        $this->environment->addExtension(new WpGetSidebarExtension()); // {% do get_sidebar() %} / {{ get_sidebar() }}
        $this->environment->addExtension(new WpRedefinedFunctionExtension()); // куча функций
        $this->environment->addExtension(new VariableConversionExtension()); // конвертация переменных (str->int, int->bool и т.д.)
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