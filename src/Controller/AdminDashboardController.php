<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(EntityManagerInterface $manager)
    {
        $kids = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Child c')->getSingleScalarResult();
        $donors = $manager->createQuery('SELECT COUNT(d) FROM App\Entity\Donor d')->getSingleScalarResult();
        $incomes = $manager->createQuery('SELECT SUM(i.amount) FROM App\Entity\Income i')->getSingleScalarResult();
        $expenses = $manager->createQuery('SELECT SUM(e.amount) FROM App\Entity\Expense e')->getSingleScalarResult();

        $greatestDonors = $manager->createQuery(
            'SELECT SUM(i.amount) as donation, d.name, d.id, d.type, d.adresse
            FROM App\Entity\Income i
            JOIN i.donor d
            GROUP BY d.name, d.id, d.type, d.adresse
            ORDER BY SUM(i.amount) DESC'
            )->setMaxResults(5)
             ->getResult();

        $leastDonors = $manager->createQuery(
            'SELECT SUM(i.amount) as donation, d.name, d.id, d.type, d.adresse
            FROM App\Entity\Income i
            JOIN i.donor d
            GROUP BY d.name, d.id, d.type, d.adresse
            ORDER BY SUM(i.amount) ASC'
            )->setMaxResults(5)
            ->getResult();

        $greatestExpCats = $manager->createQuery(
            'SELECT SUM(e.amount) as expend, c.name
            FROM App\Entity\Expense e
            JOIN e.categoryExpense c
            GROUP BY c.name
            ORDER BY SUM(e.amount) DESC'
            )->setMaxResults(5)
            ->getResult();

        $leastExpCats = $manager->createQuery(
            'SELECT SUM(e.amount) as expend, c.name
            FROM App\Entity\Expense e
            JOIN e.categoryExpense c
            GROUP BY c.name
            ORDER BY SUM(e.amount) ASC'
            )->setMaxResults(5)
            ->getResult();

        return $this->render('admin/dashboard/index.html.twig', [
            'bodyTitle' => 'Tableau de bord',
            'stats'     =>  compact('kids','donors','incomes','expenses'),
            'greatestDonors'    =>  $greatestDonors,
            'leastDonors'       =>  $leastDonors,
            'greatestExpCats'    =>  $greatestExpCats,
            'leastExpCats'       =>  $leastExpCats
        ]);
    }
}
