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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataForSeoLocation::class);
    }

    // /**
    //  * @return DataForSeoLocation[] Returns an array of DataForSeoLocation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DataForSeoLocation
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
