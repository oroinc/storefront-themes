<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\ProductBundle\Migrations\Data\ORM\LoadDisplayPriceTiersAsThemeConfigurationData;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Load Display Price Tiers As Theme Configurations Data For Golden Carbon Theme
 */
class LoadGoldenCarbonDisplayPriceTiersAsThemeConfigurationData extends LoadDisplayPriceTiersAsThemeConfigurationData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalGoldenCarbonThemeConfigurationData::class,
        ];
    }

    #[\Override]
    protected function getFrontendTheme(ConfigManager $configManager, ?object $scope = null): ?string
    {
        return 'golden_carbon';
    }

    #[\Override]
    protected function getThemeConfigurations(ObjectManager $manager, ?object $scope = null): array
    {
        return $manager->getRepository(ThemeConfiguration::class)->findBy([
            'theme' => $this->getFrontendTheme($this->configManager, $scope)
        ]);
    }
}
