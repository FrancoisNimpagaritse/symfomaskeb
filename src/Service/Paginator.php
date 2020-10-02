<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class Paginator
{
    private $entityClass;
    private $limit = 10;
    private $page = 1;
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getPages()
    {
        //1) Connaitre le total des enregistrements de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        //2) Faire la division, l'arrondi et le renvoyer
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData()
    {
        //1) Calculer l'offset: début de la page
        $offset = $this->currentPage * $this->limit - $this->limit;

        //2) Demander au repository de trouver les éléments
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);

        //3) Envoyer les éléments
        return $data;
    }

    /**
     * Get the value of entityClass
     */ 
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Set the value of entityClass
     *
     * @return  self
     */ 
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    /**
     * Get the value of limit
     */ 
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */ 
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the value of current page
     */ 
    public function getPage()
    {
        return $this->currentPage;
    }

    /**
     * Set the value of current page
     *
     * @return  self
     */ 
    public function setPage($page)
    {
        $this->currentPage = $page;

        return $this;
    }
}