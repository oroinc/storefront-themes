<?php

declare(strict_types=1);

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\Demo\ORM;

use Oro\Bundle\CMSBundle\Migrations\Data\Demo\ORM\AbstractLoadPromotionContentBlockData;
use Oro\Bundle\CMSBundle\Migrations\Data\Demo\ORM\LoadPromotionContentBlockData;
use Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM\LoadGlobalGoldenCarbonThemeConfigurationData;

/**
 * Loads promotional content block data and configures system config for organizations for Golden Carbon Theme
 */
class LoadGoldenCarbonPromotionContentBlockData extends AbstractLoadPromotionContentBlockData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadPromotionContentBlockData::class,
            LoadGlobalGoldenCarbonThemeConfigurationData::class,
        ];
    }

    #[\Override]
    protected function getFrontendTheme(): ?string
    {
        return 'golden_carbon';
    }
}
