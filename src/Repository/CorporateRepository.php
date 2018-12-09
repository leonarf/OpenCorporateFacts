<?php

namespace App\Repository;

use App\Entity\Corporate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Corporate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Corporate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Corporate[]    findAll()
 * @method Corporate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorporateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Corporate::class);
    }

    /**
     * @return Corporate[] Returns an array of Corporate objects
     */
    public function findByName($value)
    {
        return $this->createQueryBuilder('corporate')
            ->andWhere('corporate.Name = :val')
            ->setParameter('val', $value)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Corporate
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
