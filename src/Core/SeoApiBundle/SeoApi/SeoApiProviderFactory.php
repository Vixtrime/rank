<?php

namespace App\Core\SeoApiBundle\SeoApi;

use App\API\DataForSeoBundle\Client\DataForSeoApiProvider;
use App\Core\BaseBundle\Helpers\ContainerService;
use Psr\Container\ContainerInterface;

/**
 * Class SeoApiProviderFactory
 * @package App\Core\SeoApiBundle\SeoApi
 */
class SeoApiProviderFactory
{
    /**
     * @var ContainerService $kernel
     */
    private $containerService;

    /**
     * SeoApiProviderFactory constructor.
     * @param ContainerService $containerService
     */
    public function __construct(ContainerService $containerService)
    {
        $this->containerService = $containerService;
    }

    /**
     * @param $seoApiProviderName
     * @return SeoApiProviderInterface
     */
    public function getSeoApiProvider($seoApiProviderName): SeoApiProviderInterface
    {
        switch ($seoApiProviderName) {
            case DataForSeoApiProvider::getApiProviderName():
                return $this->containerService->getFromContainer(DataForSeoApiProvider::class);
                break;
        }
    }
}