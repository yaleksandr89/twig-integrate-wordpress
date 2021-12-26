<?php

namespace FunctionsModules\Twig\Extension;

use Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Template;
use Twig\TwigFunction;

use function func_get_args;
use function func_num_args;

class SymfonyDebugExtension extends AbstractExtension
{
    private ClonerInterface $cloner;
    private ?HtmlDumper $dumper;

    public function __construct(ClonerInterface $cloner, HtmlDumper $dumper = null)
    {
        $this->cloner = $cloner;
        $this->dumper = $dumper;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('dump', [$this, 'dump'], ['is_safe' => ['html'], 'needs_context' => true, 'needs_environment' => true]),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'dump';
    }

    /**
     * @param Environment $env
     * @param $context
     *
     * @return false|string|null
     */
    public function dump(Environment $env, $context)
    {
        if ( ! $env->isDebug()) {
            return null;
        }

        if (2 === func_num_args()) {
            $vars = [];
            foreach ($context as $key => $value) {
                if ( ! $value instanceof Template) {
                    $vars[$key] = $value;
                }
            }

            $vars = [$vars];
        } else {
            $vars = func_get_args();
            unset($vars[0], $vars[1]);
        }

        $dump         = fopen('php://memory', 'rb+');
        $this->dumper = $this->dumper ?? new HtmlDumper();
        $this->dumper->setCharset($env->getCharset());

        foreach ($vars as $value) {
            $this->dumper->dump($this->cloner->cloneVar($value), $dump);
        }

        return stream_get_contents($dump, -1, 0);
    }
}
