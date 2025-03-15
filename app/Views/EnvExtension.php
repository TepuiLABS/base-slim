<?php

namespace App\Views;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EnvExtension extends AbstractExtension
{
    public function getFunctions(): array
	{
        return [
            new TwigFunction('env', [$this, 'env'])
        ];
    }

    public function env($key)
    {
        return $_ENV[$key] ?? null;
    }
}
