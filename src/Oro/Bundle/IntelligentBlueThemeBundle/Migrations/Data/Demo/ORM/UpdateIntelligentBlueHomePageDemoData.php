<?php

declare(strict_types=1);

namespace Oro\Bundle\IntelligentBlueThemeBundle\Migrations\Data\Demo\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CMSBundle\Migrations\Data\Demo\ORM\LoadHomePageDemoData;
use Oro\Bundle\DistributionBundle\Handler\ApplicationState;
use Oro\Component\DependencyInjection\ContainerAwareInterface;
use Oro\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Updates the Homepage content for Intelligent Blue Theme.
 * Replaces the content block reference from "home-page-slider" to "intelligent-blue-home-page-slider".
 */
class UpdateIntelligentBlueHomePageDemoData extends AbstractFixture implements
    DependentFixtureInterface,
    ContainerAwareInterface
{
    use ContainerAwareTrait;

    #[\Override]
    public function getDependencies(): array
    {
        return [
            LoadHomePageDemoData::class,
            IntelligentBlueThemeLoadImageSliderDemoData::class,
        ];
    }

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        // Only run on new installations, skip if the application is already installed
        if ($this->container->get(ApplicationState::class)->isInstalled()) {
            return;
        }

        $this->updateHomePageContent($manager);
    }

    private function updateHomePageContent(ObjectManager $manager): void
    {
        $homepage = $this->getReference('homepage');
        if (!$homepage) {
            return;
        }

        $content = $homepage->getContent();
        if (!$content) {
            return;
        }

        $updatedContent = str_replace(
            '{{ content_block("home-page-slider") }}',
            '{{ content_block("intelligent-blue-home-page-slider") }}',
            $content
        );

        if ($content !== $updatedContent) {
            $homepage->setContent($updatedContent);
            $manager->flush();
        }
    }
}
