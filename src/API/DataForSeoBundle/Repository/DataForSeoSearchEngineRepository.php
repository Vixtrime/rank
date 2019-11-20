<?php


namespace App\API\DataForSeoBundle\Repository;


use App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class DataForSeoSearchEngineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataForSeoSearchEngine::class);
    }
}