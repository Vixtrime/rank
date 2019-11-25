<?php


namespace App\API\DataForSeoBundle\Repository;


use App\API\DataForSeoBundle\Entity\DataForSeoLocation;
use App\API\DataForSeoBundle\Entity\DataForSeoRankTask;
use App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method DataForSeoRankTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataForSeoRankTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataForSeoRankTask[]    findAll()
 * @method DataForSeoRankTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataForSeoRankTaskRepository extends ServiceEntityRepository
{
    /**
     * DataForSeoRankTaskRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataForSeoRankTask::class);
    }

    public function createRankTask(string $token, int $priority, string $site, DataForSeoSearchEngine $se, DataForSeoLocation $loc)
    {
        return new DataForSeoRankTask($token, $priority, $site, $se, $loc);
    }

    /**
     * @param DataForSeoRankTask $task
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(DataForSeoRankTask $task)
    {
        $this->_em->persist($task);
        $this->_em->flush();
    }

    public function getTasks()
    {
        return $this->_em->createQueryBuilder()
            ->select('t.id', 't.apiId', 't.site', 't.priority', 't.resultSeCheckUrl', 't.resultsCount',
                't.resultSnippet', 't.resultExtra', 't.resultTitle', 't.resultUrl', 't.resultPosition',
                't.status', 'l.locName', 's.name', 's.language', 'k.keyValue')
            ->from('App\API\DataForSeoBundle\Entity\DataForSeoRankTask', 't')
            ->leftJoin('App\API\DataForSeoBundle\Entity\DataForSeoLocation', 'l', 'WITH', 't.loc = l.id')
            ->leftJoin('App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine', 's', 'WITH', 't.se = s.id')
            ->leftJoin('App\API\DataForSeoBundle\Entity\DataForSeoKey', 'k', 'WITH', 't.key = k.id')
            ->getQuery()
            ->execute();
    }
}