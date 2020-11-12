<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class Stats
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getStats()
    {
        $kids = $this->getKidsCount();
        $donors = $this->getDonorsCount();
        $donorsMembres = $this->getDonorsCount();
        $donorsMembresLocaux = $this->getDonorsTypeAndLocalisationCount('Membre', 'Burundi');
        $donorsMembresEtrangers = $this->getDonorsTypeAndLocalisationCount('Membre', 'France');
        $donorsTrue = $this->getDonorsTypeCount('Donateur');
        $incomes = $this->getIncomesTotal();
        $expenses = $this->getExpensesTotal();

        return compact('kids','donors', 'donorsMembres','donorsMembresLocaux', 'donorsMembresEtrangers','donorsTrue','incomes','expenses');
    }

    public function getKidsCount()
    {
        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\Child c')->getSingleScalarResult();
    }

    public function getDonorsCount()
    {
        return $this->manager->createQuery('SELECT COUNT(d) FROM App\Entity\Donor d')->getSingleScalarResult();
    }

    public function getDonorsTypeAndLocalisationCount($type, $localisation)
    {
        return $this->manager->createQuery("SELECT COUNT(d) FROM App\Entity\Donor d WHERE d.type='" . $type ."' AND d.geolocalisation='" . $localisation ."'")->getSingleScalarResult();
    }

    public function getDonorsTypeCount($type)
    {
        return $this->manager->createQuery("SELECT COUNT(d) FROM App\Entity\Donor d WHERE d.type='" . $type ."'")->getSingleScalarResult();
    }

    public function getIncomesTotal()
    {
        return $this->manager->createQuery('SELECT SUM(i.amount) FROM App\Entity\Income i')->getSingleScalarResult();
    }

    public function getExpensesTotal()
    {
        return $this->manager->createQuery('SELECT SUM(e.amount) FROM App\Entity\Expense e')->getSingleScalarResult();
    }

    public function getDonorsStats($order)
    {
        return $this->manager->createQuery(
            'SELECT SUM(i.amount) as donation, d.name, d.id, d.type, d.adresse
            FROM App\Entity\Income i
            JOIN i.donor d
            GROUP BY d.name, d.id, d.type, d.adresse
            ORDER BY SUM(i.amount) '. $order
            )->setMaxResults(5)
             ->getResult();
    }

    public function getExpCatsStats($order)
    {
        return $this->manager->createQuery(
            'SELECT SUM(e.amount) as expend, c.name
            FROM App\Entity\Expense e
            JOIN e.categoryExpense c
            GROUP BY c.name
            ORDER BY SUM(e.amount) '. $order
            )->setMaxResults(5)
            ->getResult();
    }
}