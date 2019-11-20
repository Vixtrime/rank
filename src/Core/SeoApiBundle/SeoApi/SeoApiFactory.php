<?php


namespace App\Core\SeoApiBundle\SeoApi;


use App\API\DataForSeoBundle\Client\DataForSeoApiProcessor;
use Psr\Container\ContainerInterface;

class SeoApiFactory
{

    /**
     * @var ContainerInterface $kernel
     */
    private $kernel;

    /**
     * SeoApiFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->kernel = $container;
    }

    /**
     * @param $apiName
     * @return SeoApiProcessorInterface
     */
    public function getSeoApiProcessor($apiName): SeoApiProcessorInterface
    {
        switch ($apiName) {
            case DataForSeoApiProcessor::getSeoApiName():
                return $this->getFromContainer(DataForSeoApiProcessor::class);
                break;
        }
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function getFromContainer(string $class)
    {
        if ($this->kernel->has($class)) {
            return $this->kernel->get($class);
        }
        //TODO if class doesnt exist;
    }
}