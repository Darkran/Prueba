<?php

namespace App\Repository;

use App\Entity\Conversiones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conversiones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conversiones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conversiones[]    findAll()
 * @method Conversiones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConversionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conversiones::class);
    }

    // /**
    //  * @return Conversiones[] Returns an array of Conversiones objects
    //  */
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
    public function findOneBySomeField($value): ?Conversiones
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
