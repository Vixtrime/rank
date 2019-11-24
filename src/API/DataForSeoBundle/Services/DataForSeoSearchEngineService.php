<?php


namespace App\API\DataForSeoBundle\Services;


use App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine;
use App\API\DataForSeoBundle\Repository\DataForSeoSearchEngineRepository;

class DataForSeoSearchEngineService
{
    /**
     * @var
     */
    private $dataForSeoSearchEngineRepository;

    public function __construct(DataForSeoSearchEngineRepository $searchEngineRepository)
    {
        $this->dataForSeoSearchEngineRepository = $searchEngineRepository;
    }

    public function getSearchEnginesInFormFormat()
    {
        $prepared = [];

        if (!empty($se = $this->getSearchEngines())) {
            foreach ($se as $id => $engine) {
                $prepared[$id]['name'] = $engine['name'] . ' (language:' . $engine['language'] . '; localization:' . $engine['localization'] . ')';
                $prepared[$id]['id'] = $engine['id'];
            }
        }
        return $prepared;
    }

    public function getSearchEngines()
    {
        return $this->dataForSeoSearchEngineRepository->getSearchEngines();
    }

    /**
     * @param $id
     * @return DataForSeoSearchEngine|null
     */
    public function getSearchEngineById($id)
    {
        return $this->dataForSeoSearchEngineRepository->findOneBy(['id' => $id]);
    }
}
