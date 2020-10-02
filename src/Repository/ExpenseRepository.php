<?php

namespace App\Repository;

use App\Entity\Expense;
use App\Entity\RechercheExpense;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Expense|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expense|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expense[]    findAll()
 * @method Expense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expense::class);
    }

    
    // /**
    //  * @return Expense[] Returns an array of Expense objects
    //  */
    public function findAllByDate(RechercheExpense $rechercheExpense)
    {
        $qry =  $this->createQueryBuilder('i')->orderBy('i.dateExpense', 'DESC');

            if($rechercheExpense->getStartDate())
            {
                $qry = $qry->andWhere('i.dateExpense >= :min')
                            ->setParameter(':min', $rechercheExpense->getStartDate());
            }
            
            if($rechercheExpense->getEndDate())
            {
                $qry = $qry->andWhere('i.dateExpense <= :max')
                            ->setParameter(':max', $rechercheExpense->getEndDate());
            }
            
        return $qry->getQuery()
                    ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Expense
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
