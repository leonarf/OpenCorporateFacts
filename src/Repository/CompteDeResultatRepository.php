<?php

namespace App\Repository;

use App\Entity\CompteDeResultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompteDeResultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteDeResultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteDeResultat[]    findAll()
 * @method CompteDeResultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteDeResultatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompteDeResultat::class);
    }

//    /**
//     * @return CompteDeResultat[] Returns an array of CompteDeResultat objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompteDeResultat
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
