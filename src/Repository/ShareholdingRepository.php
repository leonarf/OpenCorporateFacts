<?php

namespace App\Repository;

use App\Entity\Shareholding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Shareholding|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shareholding|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shareholding[]    findAll()
 * @method Shareholding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShareholdingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shareholding::class);
    }

//    /**
//     * @return Shareholding[] Returns an array of Shareholding objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shareholding
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
