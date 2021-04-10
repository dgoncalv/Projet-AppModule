<?php

namespace App\Repository;

use App\Entity\ModuleDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModuleDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModuleDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModuleDetails[]    findAll()
 * @method ModuleDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModuleDetails::class);
    }
}
