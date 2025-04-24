<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM;

use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CMSBundle\Migrations\Data\ORM\LoadProductsSegmentContentWidgetData;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;

/**
 * Class to load "product_segment" content widget's data and configures theme configuration for golden carbon theme
 */
class LoadGoldenCarbonProductsSegmentContentWidgetData extends LoadProductsSegmentContentWidgetData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadGlobalGoldenCarbonThemeConfigurationData::class,
            LoadProductsSegmentContentWidgetData::class
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
