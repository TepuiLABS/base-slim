<?php

namespace App\Views;

use Twig\TwigFunction;

class EnvExtension extends \Twig\Extension\AbstractExtension
{
    public function getFunctions()
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
