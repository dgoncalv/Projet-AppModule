<?php

namespace App\Repository;

use App\Domain\MaquetteEnseignement;
use App\Entity\Module;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ModuleRepository
 * @package App\Repository
 */
class ModuleRepository extends ServiceEntityRepository implements MaquetteEnseignement
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Module::class);
    }

    /**
     * @param Module $module
     */
    public function save(Module $module)
    {
        try {
            $this->_em->persist($module);
        } catch (ORMException $e) {
        }
        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
        }
    }

    /**
     * @param Module $module
     * @param string $newIntitule
     */
    public function update(Module $module, string $newIntitule)
    {
        $module->setIntitule($newIntitule);

        try {
            $this->_em->persist($module);
        } catch (ORMException $e) {
        }
        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
        }
    }

    public function updateResponsable(Module $module)
    {
        try {
            $this->_em->merge($module);
        } catch (ORMException $e) {
        }
        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
        }
    }

    /**
     * @param string $semester
     * @return iterable
     */
    public function findUEsOfASemester(string $semester): iterable
    {
        $semester = "M" . $semester . "%";
        $query = $this->createQueryBuilder('m')
            ->select('SUBSTRING(m.PPN, 3, 1) as UENumber')
            ->where('m.PPN LIKE :semester')
            ->distinct(true)
            ->setParameter('semester', $semester)
            ->getQuery();
        return $query->getResult();
    }

    /**
     * @param string $semester
     * @return iterable
     */
    public function findModulesOfASemester(string $semester): iterable
    {
        $sem = array();
        $UEs = $this->findUEsOfASemester($semester);
        foreach ($UEs as $UE) {
            $UENumber = $UE['UENumber'];
            $UE = "M" . $semester . $UENumber . "%";
            $query = $this->createQueryBuilder('m')
                ->select('m.id as id')
                ->addselect('m.PPN as PPN')
                ->addSelect('m.intitule as intitule')
                ->addSelect('GROUP_CONCAT(e.trigramme SEPARATOR \' \') AS responsables')
                ->join('m.responsables', 'e')
                ->where('m.PPN LIKE :UE')
                ->groupBy('m.id')
                ->addGroupBy('m.PPN')
                ->addGroupBy('m.intitule')
                ->orderBy('m.PPN')
                ->setParameter('UE', $UE)
                ->getQuery();
            $result = $query->getResult();
            $sem['UE' . $UENumber] = $result;
        }
        return $sem;
    }
}
