<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM;

use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\FrontendBundle\Migrations\Data\ORM\LoadGlobalThemeConfigurationData;

/**
 * Load Theme Configurations Data For Golden Carbon Theme
 */
class LoadGlobalGoldenCarbonThemeConfigurationData extends LoadGlobalThemeConfigurationData
{
    public const string GOLDEN_CARBON_THEME = 'golden_carbon';

    public function getDependencies(): array
    {
        return [
            LoadGlobalThemeConfigurationData::class,
        ];
    }

    #[\Override]
    protected function isApplicable(): bool
    {
        return true;
    }

    #[\Override]
    protected function getFrontendTheme(ConfigManager $configManager, ?object $scope = null): ?string
    {
        return self::GOLDEN_CARBON_THEME;
    }

    #[\Override]
    protected function isStoreInSystemConfig(): bool
    {
        return false;
    }
}
