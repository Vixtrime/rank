<?php

namespace App\API\DataForSeoBundle\Repository;

use App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class DataForSeoSearchEngineRepository
 * @package App\API\DataForSeoBundle\Repository
 * @method DataForSeoSearchEngine|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataForSeoSearchEngine|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataForSeoSearchEngine[]    findAll()
 * @method DataForSeoSearchEngine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataForSeoSearchEngineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataForSeoSearchEngine::class);
    }

    /**
     * @return array
     */
    public function getSearchEngines()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('se.id', 'se.name', 'se.language', 'se.localization')
            ->from('App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine', 'se')
            ->getQuery()
            ->execute();
    }
}