<?php

namespace Oro\Bundle\GoldenCarbonThemeBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\CMSBundle\Entity\ContentWidget;
use Oro\Bundle\FrontendBundle\Migrations\Data\ORM\AbstractLoadFrontendTheme;
use Oro\Bundle\LayoutBundle\Layout\Extension\ThemeConfiguration as LayoutThemeConfiguration;
use Oro\Bundle\MigrationBundle\Entity\DataFixture;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use Oro\Bundle\ThemeBundle\Entity\ThemeConfiguration;
use Oro\Bundle\UserBundle\Migrations\Data\ORM\LoadAdminUserData;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Sets contact_us_form widget for theme configuration for golden carbon theme
 */
class SetContactUsFormForGoldenCarbonThemeConfiguration extends AbstractLoadFrontendTheme implements
    DependentFixtureInterface,
    ContainerAwareInterface
{
    use ContainerAwareTrait;

    public const string CONTACT_US_FORM = 'contact_us_form';

    public function getDependencies(): array
    {
        return [
            LoadAdminUserData::class,
            LoadGlobalGoldenCarbonThemeConfigurationData::class,
        ];
    }

    protected function isApplicable(ObjectManager $manager): bool
    {
        $className = 'Oro\Bridge\ContactUs\Migrations\Data\ORM\LoadContactUsFormContentWidgetData';
        $className2 = 'Oro\Bridge\ContactUs\Migrations\Data\ORM\SetContactUsFormForThemeConfiguration';

        $result = $manager->getRepository(DataFixture::class)->findBy(['className' => [$className, $className2]]);

        return \count($result) === 2;
    }

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        if (!$this->isApplicable($manager)) {
            return;
        }

        $organization = $manager->getRepository(Organization::class)->getFirst();
        $contentWidget = $manager->getRepository(ContentWidget::class)->findOneBy([
            'name' => self::CONTACT_US_FORM,
            'organization' => $organization
        ]);

        if (!$contentWidget) {
            return;
        }

        $themeConfigurations = $this->getThemeConfigurations($manager, $organization);
        if (!$themeConfigurations) {
            return;
        }

        $doFlush = false;
        foreach ($themeConfigurations as $themeConfiguration) {
            $key = LayoutThemeConfiguration::buildOptionKey('contact_us', self::CONTACT_US_FORM);
            if (!$themeConfiguration->getConfigurationOption($key)) {
                $themeConfiguration->addConfigurationOption($key, $contentWidget->getId());
                $doFlush = true;
            }
        }

        if ($doFlush) {
            $manager->flush();
        }
    }

    protected function getThemeConfigurations(ObjectManager $manager, Organization $organization): array
    {
        return $manager->getRepository(ThemeConfiguration::class)->findBy([
            'theme' => $this->getFrontendTheme(),
            'organization' => $organization
        ]);
    }

    protected function getFrontendTheme(): ?string
    {
        return 'golden_carbon';
    }
}
