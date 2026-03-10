<?php

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\ORM;

use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\FrontendBundle\Migrations\Data\ORM\LoadGlobalThemeConfigurationData;

/**
 * Load Theme Configurations Data For Intelligent Blue Theme
 */
class LoadGlobalIntelligentBlueThemeConfigurationData extends LoadGlobalThemeConfigurationData
{
    public const string INTELLIGENT_BLUE_THEME = 'intelligent_blue';

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
        return self::INTELLIGENT_BLUE_THEME;
    }

    #[\Override]
    protected function isStoreInSystemConfig(): bool
    {
        return false;
    }
}
