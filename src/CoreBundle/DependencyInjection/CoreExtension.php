<?php

namespace CoreBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('twig.form.resources', array_merge(
            array('CoreBundle:Form:fields.html.twig'),
            $container->getParameter('twig.form.resources')
        ));
    }
}