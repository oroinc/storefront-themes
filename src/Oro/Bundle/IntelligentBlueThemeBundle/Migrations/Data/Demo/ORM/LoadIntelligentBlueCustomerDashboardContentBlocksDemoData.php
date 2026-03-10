<?php

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\Demo\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CommerceBundle\Migrations\Data\Demo\ORM\LoadCustomerDashboardContentBlocksDemoData;
use Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\ORM\LoadGlobalIntelligentBlueThemeConfigurationData;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Loads customer dashboards content block data and configures theme configuration for Intelligent Blue Theme
 */
class LoadIntelligentBlueCustomerDashboardContentBlocksDemoData extends LoadCustomerDashboardContentBlocksDemoData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalIntelligentBlueThemeConfigurationData::class,
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
        return 'intelligent_blue';
    }
}
