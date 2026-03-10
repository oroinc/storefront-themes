<?php

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\ProductBundle\Migrations\Data\ORM\LoadDisplayPriceTiersAsThemeConfigurationData;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Load Display Price Tiers As Theme Configurations Data For Intelligent Blue Theme
 */
class LoadIntelligentBlueDisplayPriceTiersAsThemeConfigurationData extends LoadDisplayPriceTiersAsThemeConfigurationData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalIntelligentBlueThemeConfigurationData::class,
        ];
    }

    #[\Override]
    protected function getFrontendTheme(ConfigManager $configManager, ?object $scope = null): ?string
    {
        return 'intelligent_blue';
    }

    #[\Override]
    protected function getThemeConfigurations(ObjectManager $manager, ?object $scope = null): array
    {
        return $manager->getRepository(ThemeConfiguration::class)->findBy([
            'theme' => $this->getFrontendTheme($this->configManager, $scope)
        ]);
    }
}
