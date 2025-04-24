<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CommerceBundle\Migrations\Data\ORM\LoadCustomerDashboardContentWidgetData;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Loads customer dashboards datagrid content widget data and configures theme configuration for golden carbon theme
 */
class LoadGoldenCarbonCustomerDashboardContentWidgetData extends LoadCustomerDashboardContentWidgetData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalGoldenCarbonThemeConfigurationData::class,
            LoadCustomerDashboardContentWidgetData::class
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
