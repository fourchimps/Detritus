<?php

namespace FourChimps\AdminBundle\Generator;

use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Bundle\DoctrineBundle\Mapping\ClassMetadataCollection;
use Doctrine\Bundle\DoctrineBundle\Mapping\ClassMetadata;
use \Symfony\Component\HttpKernel\Bundle\BundleInterface;

class NavigationGenerator
{
    private $filesystem;
    private $skeletonDir;

    public function __construct(Filesystem $filesystem, $skeletonDir)
    {
        $this->filesystem = $filesystem;
        $this->skeletonDir = $skeletonDir;
    }


    public function generate(BundleInterface $bundle, ClassMetadataCollection $metadata, $format)
    {

//        echo(get_class($x));
        foreach($metadata->getMetadata() as $classMetaData) {

            echo $bundle->getNamespace();
            print_r($classMetaData);
            echo "\n";
        }


//        $dir = $bundle->getPath();
//
//
//        $parts = explode('\\', $this->entity);
//        $entityClass = array_pop($parts);
//        $entityNamespace = implode('\\', $parts);
//
//        $target = sprintf(
//            '%s/Controller/%s/%sController.php',
//            $dir,
//            str_replace('\\', '/', $entityNamespace),
//            $entityClass
//        );
//
//        if (file_exists($target)) {
//            throw new \RuntimeException('Unable to generate the controller as it already exists.');
//        }
//
//        $this->renderFile($this->skeletonDir, 'controller.php', $target, array(
//            'actions'           => $this->actions,
//            'route_prefix'      => $this->routePrefix,
//            'route_name_prefix' => $this->routeNamePrefix,
//            'dir'               => $this->skeletonDir,
//            'bundle'            => $this->bundle->getName(),
//            'entity'            => $this->entity,
//            'entity_class'      => $entityClass,
//            'namespace'         => $this->bundle->getNamespace(),
//            'entity_namespace'  => $entityNamespace,
//            'format'            => $this->format,
//            'entity_bundle'     => $this->entityBundleName,
//            'entity_bundle_namespace' => $this->entityBundle->getNamespace(),
//        ));



    }

}