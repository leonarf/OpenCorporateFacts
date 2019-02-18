<?php

namespace App\Repository;

use App\Entity\DocumentDeReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DocumentDeReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentDeReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentDeReference[]    findAll()
 * @method DocumentDeReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentDeReferenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DocumentDeReference::class);
    }

//    /**
//     * @return DocumentDeReference[] Returns an array of DocumentDeReference objects
//     */
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
    public function findOneBySomeField($value): ?DocumentDeReference
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
