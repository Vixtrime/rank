<?php


namespace App\API\DataForSeoBundle\Repository;

use App\API\DataForSeoBundle\Entity\DataForSeoKey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DataForSeoKey|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataForSeoKey|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataForSeoKey[]    findAll()
 * @method DataForSeoKey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataForSeoKeyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataForSeoKey::class);
    }
}