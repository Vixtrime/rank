<?php

namespace App\Core\BaseBundle\Helpers;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    public $logger;

    /**
     * ContainerService constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     */
    public function __construct(ContainerInterface $container, LoggerInterface $logger)
    {
        $this->container = $container;
        $this->logger = $logger;
    }

    /**
     * @param string $className
     * @return mixed
     * @throws \Exception
     */
    public function getFromContainer(string $className)
    {
        if ($this->container->has($className)) {
            return $this->container->get($className);
        }
        $this->logger->error('Trying to get class with name ' . $className);
        throw new \Exception('Something went wrong. Please try again');
    }
}
