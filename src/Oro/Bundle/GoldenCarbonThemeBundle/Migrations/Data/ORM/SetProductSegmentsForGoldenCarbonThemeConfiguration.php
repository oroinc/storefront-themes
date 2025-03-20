<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CMSBundle\Migrations\Data\ORM\SetProductSegmentsForThemeConfiguration;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Sets product segments for theme configuration for already installed applications for golden carbon theme
 */
class SetProductSegmentsForGoldenCarbonThemeConfiguration extends SetProductSegmentsForThemeConfiguration
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            SetProductSegmentsForThemeConfiguration::class,
            LoadGlobalGoldenCarbonThemeConfigurationData::class
        ];
    }

    #[\Override]
    protected function getThemeConfigurations(ObjectManager $manager, Organization $organization): array
    {
        return $manager->getRepository(ThemeConfiguration::class)->findBy([
            'theme' => $this->getFrontendTheme(),
            'organization' => $organization
        ]);
    }

    #[\Override]
    protected function getFrontendTheme(): ?string
    {
        return 'golden_carbon';
    }
}
