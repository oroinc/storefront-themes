<?php

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CommerceBundle\Migrations\Data\ORM\LoadScorecardContentWidgetData;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Loads customer dashboards scorecard content widget data and configures theme configuration for Intelligent Blue Theme
 */
class LoadIntelligentBlueScorecardContentWidgetData extends LoadScorecardContentWidgetData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalIntelligentBlueThemeConfigurationData::class,
            LoadScorecardContentWidgetData::class
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
