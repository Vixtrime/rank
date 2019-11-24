<?php


namespace App\API\DataForSeoBundle\Services;


use App\API\DataForSeoBundle\Repository\DataForSeoLocationRepository;

class DataForSeoLocationService
{
    /**
     * @var DataForSeoLocationRepository
     */
    private $dataForSeoLocationRepository;

    /**
     * DataForSeoLocationService constructor.
     * @param DataForSeoLocationRepository $locationRepository
     */
    public function __construct(DataForSeoLocationRepository $locationRepository)
    {
        $this->dataForSeoLocationRepository = $locationRepository;
    }

    public function getLocationsData()
    {
        return $this->dataForSeoLocationRepository->getLocationsData();
    }

    public function getLocationById($id)
    {
        return $this->dataForSeoLocationRepository->findOneBy(['id' => $id]);
    }
}