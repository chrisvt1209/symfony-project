<?php

namespace App\Twig;

use Symfony\Component\Intl\Locales;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class AppExtension extends AbstractExtension
{
    private ?array $locales = null;

    public function __construct(
        private readonly array $enabledLocales,
        private readonly string $defaultLocale,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('locales', [$this, 'getLocales']),
            new TwigFunction('isrtl', [$this, 'isRtl']),
        ];
    }

    public function getLocales(): array
    {
        if (null !== $this->locales) {
            return $this->locales;
        }

        $this->locales = [];

        foreach ($this->enabledLocales as $localeCode) {
            $this->locales[] = ['code' => $localeCode, 'name' => Locales::getName($localeCode, $localeCode)];
        }

        return $this->locales;
    }

    public function isRtl(?string $locale = null): bool
    {
        $locale = $locale ?? $this->defaultLocale;

        return \in_array($locale, ['ar', 'fa', 'he', 'ur', 'ps', 'sd'], true);
    }
}
