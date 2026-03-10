<?php

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CMSBundle\Migrations\Data\ORM\SetProductSegmentsForThemeConfiguration;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Sets product segments for theme configuration for already installed applications for Intelligent Blue Theme
 */
class SetProductSegmentsForIntelligentBlueThemeConfiguration extends SetProductSegmentsForThemeConfiguration
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalIntelligentBlueThemeConfigurationData::class,
            SetProductSegmentsForThemeConfiguration::class
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
        return 'intelligent_blue';
    }
}
