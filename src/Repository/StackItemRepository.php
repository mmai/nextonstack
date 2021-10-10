<?php

namespace App\Repository;

use App\Entity\StackItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StackItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method StackItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method StackItem[]    findAll()
 * @method StackItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StackItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StackItem::class);
    }

    // /**
    //  * @return StackItem[] Returns an array of StackItem objects
    //  */
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
    public function findOneBySomeField($value): ?StackItem
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
