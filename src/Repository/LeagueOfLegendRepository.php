<?php

namespace App\Repository;

use App\Entity\LeagueOfLegend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LeagueOfLegend|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeagueOfLegend|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeagueOfLegend[]    findAll()
 * @method LeagueOfLegend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeagueOfLegendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeagueOfLegend::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LeagueOfLegend $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(LeagueOfLegend $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return LeagueOfLegend[] Returns an array of LeagueOfLegend objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeagueOfLegend
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
