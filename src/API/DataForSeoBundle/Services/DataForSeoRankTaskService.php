<?php


namespace App\API\DataForSeoBundle\Services;


use App\API\DataForSeoBundle\Repository\DataForSeoRankTaskRepository;

class DataForSeoRankTaskService
{
    /**
     * @var DataForSeoRankTaskRepository
     */
    private $rankTaskRepository;

    /**
     * DataForSeoRankTaskService constructor.
     * @param DataForSeoRankTaskRepository $rankTaskRepository
     */
    public function __construct(DataForSeoRankTaskRepository $rankTaskRepository)
    {
        $this->rankTaskRepository = $rankTaskRepository;
    }

}