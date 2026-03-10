<?php

declare(strict_types=1);

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\Demo\ORM;

use Oro\Bundle\CMSBundle\Migrations\Data\Demo\ORM\AbstractLoadPromotionContentBlockData;
use Oro\Bundle\CMSBundle\Migrations\Data\Demo\ORM\LoadPromotionContentBlockData;
use Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\ORM\LoadGlobalIntelligentBlueThemeConfigurationData;

/**
 * Loads promotional content block data and configures system config for organizations for Intelligent Blue Theme
 */
class LoadIntelligentBluePromotionContentBlockData extends AbstractLoadPromotionContentBlockData
{
    #[\Override]
    public function getDependencies(): array
    {
        return [
            ...parent::getDependencies(),
            LoadPromotionContentBlockData::class,
            LoadGlobalIntelligentBlueThemeConfigurationData::class,
        ];
    }

    #[\Override]
    protected function getFrontendTheme(): ?string
    {
        return 'intelligent_blue';
    }
}
