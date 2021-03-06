<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),

            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new JJs\Bundle\GeonamesBundle\JJsGeonamesBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            
            new Myclapboard\ArtistBundle\MyclapboardArtistBundle(),
            new Myclapboard\AwardBundle\MyclapboardAwardBundle(),
            new Myclapboard\CoreBundle\MyclapboardCoreBundle(),
            new Myclapboard\MovieBundle\MyclapboardMovieBundle(),
            new Myclapboard\UserBundle\MyclapboardUserBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function getCacheDir()
    {
        $filename = '/dev/shm/symfony/cache/';

        if (in_array($this->environment, array('dev', 'test')) && file_exists($filename)) {
            return $filename . $this->environment;
        }

        return parent::getCacheDir();
    }

    public function getLogDir()
    {
        $filename = '/dev/shm/symfony/logs/';

        if (in_array($this->environment, array('dev', 'test')) && file_exists($filename)) {
            return $filename . $this->environment;
        }

        return parent::getLogDir();
    }
}
