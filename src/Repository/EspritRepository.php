<?php

namespace App\Repository;

use App\Entity\Esprit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Esprit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Esprit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Esprit[]    findAll()
 * @method Esprit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspritRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Esprit::class);
    }

    // /**
    //  * @return Esprit[] Returns an array of Esprit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Esprit
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
