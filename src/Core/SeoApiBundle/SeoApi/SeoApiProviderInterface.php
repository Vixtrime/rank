<?php

namespace App\Core\SeoApiBundle\SeoApi;

/**
 * Interface SeoApiProviderInterface
 * @package App\Core\SeoApiBundle\SeoApi
 */
interface SeoApiProviderInterface
{
    /**
     * @return string
     */
    public static function getApiProviderName(): string;

    /**
     * @param string $apiProcessorName
     * @return SeoApiProcessorInterface
     */
    public function getApiProcessor(string $apiProcessorName): SeoApiProcessorInterface;
}
