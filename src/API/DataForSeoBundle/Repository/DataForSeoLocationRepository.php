<?php

namespace App\API\DataForSeoBundle\Repository;

use App\API\DataForSeoBundle\Entity\DataForSeoLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DataForSeoLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataForSeoLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataForSeoLocation[]    findAll()
 * @method DataForSeoLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataForSeoLocationRepository extends ServiceEntityRepository
{
    /**
     * DataForSeoLocationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataForSeoLocation::class);
    }

    /**
     * @return array
     */
    public function getLocationsData(): array
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('l.id', 'l.locNameCanonical')
            ->from('App\API\DataForSeoBundle\Entity\DataForSeoLocation', 'l')
            ->getQuery()
            ->execute();
    }
}
