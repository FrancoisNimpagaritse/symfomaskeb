<?php

namespace App\Repository;

use App\Entity\CategoryIncome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryIncome|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryIncome|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryIncome[]    findAll()
 * @method CategoryIncome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryIncomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryIncome::class);
    }

    // /**
    //  * @return CategoryIncome[] Returns an array of CategoryIncome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryIncome
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
