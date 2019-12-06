<?php

namespace App\Repository;

use App\Entity\CompteDeResultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CompteDeResultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteDeResultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteDeResultat[]    findAll()
 * @method CompteDeResultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteDeResultatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteDeResultat::class);
    }

  /**
   * @return CompteDeResultat[] Returns an array of CompteDeResultat objects
   */
  public function findTops($maxResults, $orderByProperty)
  {
    $qb = $this->createQueryBuilder('compte')
        ->orderBy('compte.'.$orderByProperty, 'DESC')
        ->groupby('compte.Corporate')
        ->setMaxResults($maxResults)
        ->getQuery();

    return $qb->execute();
  }

  /**
   * Return all CompteDeResultat that are from a company matching the APECode given as argument
   * @return CompteDeResultat[] Returns an array of CompteDeResultat objects
   */
  public function findAllFromAPECode($APECode)
  {
    $qb = $this->createQueryBuilder('compte')
        ->innerJoin('compte.Corporate', 'corpo', 'WITH', 'corpo.IndustryCode = :APECode')
        ->setParameter('APECode', $APECode)
        ->orderBy('compte.year', 'DESC')
        ->getQuery();

    return $qb->execute();
  }
}
