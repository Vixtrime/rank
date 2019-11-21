<?php

namespace App\Core\BaseBundle\Helpers;

use Psr\Container\ContainerInterface;

/**
 * Class ContainerService
 * @package App\Core\BaseBundle\Helpers
 */
class ContainerService
{
    /**
     * @var ContainerInterface
     */
    public $container;

    /**
     * ContainerService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $className
     * @return mixed
     */
    public function getFromContainer(string $className)
    {
        if ($this->container->has($className)) {
            return $this->container->get($className);
        }
        //TODO if class doesnt exist;
    }
}
