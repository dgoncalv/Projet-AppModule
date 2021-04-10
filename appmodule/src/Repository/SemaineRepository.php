<?php

namespace App\Repository;

use App\Domain\MaquetteEnseignement;
use App\Entity\Semaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class SemaineRepository
 * @package App\Repository
 */
class SemaineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Semaine::class);
    }
}
