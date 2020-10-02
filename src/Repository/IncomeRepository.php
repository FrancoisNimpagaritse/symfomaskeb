<?php

namespace App\Repository;

use App\Entity\Income;
use App\Entity\RechercheIncome;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Income|null find($id, $lockMode = null, $lockVersion = null)
 * @method Income|null findOneBy(array $criteria, array $orderBy = null)
 * @method Income[]    findAll()
 * @method Income[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Income::class);
    }

    // /**
    //  * @return Income[] Returns an array of Income objects
    //  */
   
    public function findAllByDate(RechercheIncome $rechercheIncome)
    {
        $qry =  $this->createQueryBuilder('i')->orderBy('i.dateIncome', 'DESC');

            if($rechercheIncome->getStartDate())
            {
                $qry = $qry->andWhere('i.dateIncome >= :min')
                            ->setParameter(':min', $rechercheIncome->getStartDate());
            }
            
            if($rechercheIncome->getEndDate())
            {
                $qry = $qry->andWhere('i.dateIncome <= :max')
                            ->setParameter(':max', $rechercheIncome->getEndDate());
            }
            
        return $qry->getQuery()
                    ->getResult();
    }
    

    /*
    public function findOneBySomeField($value): ?Income
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
