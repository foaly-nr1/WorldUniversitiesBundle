<?php

namespace FL\WorldUniversitiesBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FlWorldUniversitiesExtension extends Extension
{
    const CONFIG_KEY = 'fl_world_universities.config';

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $config['pathname'] = $config['path'].DIRECTORY_SEPARATOR.basename($config['source']);

        $container->setParameter(self::CONFIG_KEY, $config);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
