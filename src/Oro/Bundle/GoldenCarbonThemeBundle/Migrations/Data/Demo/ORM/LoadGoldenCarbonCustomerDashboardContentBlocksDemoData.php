<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\Demo\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CommerceBundle\Migrations\Data\Demo\ORM\LoadCustomerDashboardContentBlocksDemoData;
use Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM\LoadGlobalGoldenCarbonThemeConfigurationData;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Loads customer dashboards content block data and configures theme configuration for golden carbon theme
 */
class LoadGoldenCarbonCustomerDashboardContentBlocksDemoData extends LoadCustomerDashboardContentBlocksDemoData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalGoldenCarbonThemeConfigurationData::class,
            LoadCustomerDashboardContentBlocksDemoData::class
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
