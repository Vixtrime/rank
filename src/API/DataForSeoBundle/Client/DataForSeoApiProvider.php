<?php

namespace App\API\DataForSeoBundle\Client;

use App\Core\BaseBundle\Helpers\ContainerService;
use App\Core\SeoApiBundle\SeoApi\SeoApiProcessorInterface;
use App\Core\SeoApiBundle\SeoApi\SeoApiProviderInterface;

/**
 * Class DataForSeoApiProvider
 * @package App\API\DataForSeoBundle\Client
 */
class DataForSeoApiProvider implements SeoApiProviderInterface
{
    const API_NAME = 'data-for-seo';

    /**
     * @var ContainerService $containerService
     */
    private $containerService;

    /**
     * DataForSeoApiProvider constructor.
     * @param ContainerService $containerService
     */
    public function __construct(ContainerService $containerService)
    {
        $this->containerService = $containerService;
    }

    /**
     * @return string
     */
    public static function getApiProviderName(): string
    {
        return self::API_NAME;
    }

    /**
     * @param string $apiProcessorName
     * @return SeoApiProcessorInterface
     */
    public function getApiProcessor(string $apiProcessorName): SeoApiProcessorInterface
    {
        switch ($apiProcessorName) {
            case DataForSeoRankApiProcessor::getApiProcessorName() :
                return $this->containerService->getFromContainer(DataForSeoRankApiProcessor::class);
                break;
        }
    }
}
