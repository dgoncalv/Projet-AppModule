<?php

namespace App\Repository;

use App\Domain\FicheModule;
use App\Entity\Enseignant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class EnseignantRepository
 * @package App\Repository
 */
class EnseignantRepository extends ServiceEntityRepository implements FicheModule
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enseignant::class);
    }

    public function save($enseignant)
    {
        try {
            $this->_em->persist($enseignant);
        } catch (ORMException $e) {
        }
        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
        }
    }

    public function update(Enseignant $enseignant, $newServiceDu, $newStatut, $newContact)
    {
        $enseignant->setServiceDu($newServiceDu);
        $enseignant->setStatut($newStatut);
        $enseignant->setContact($newContact);

        try {
            $this->_em->persist($enseignant);
        } catch (ORMException $e) {
        }
        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
        }
    }

    public function delete(Enseignant $enseignant)
    {
        $interventions = $enseignant->getInterventions();
        foreach ($interventions as $intervention) {
            $enseignant->removeIntervention($intervention);
        }
        $this->_em->remove($enseignant);
        $this->_em->flush();
    }

    public function findAllForCSV()
    {
        $query = $this->createQueryBuilder('e')
            ->select('e.trigramme')
            ->addselect('CONCAT(e.prenom, \' \', e.nom)')
            ->addSelect('e.serviceDu')
            ->addSelect('e.statut')
            ->addSelect('e.contact')
            ->getQuery();
        return $query->getResult();
    }

    public function findOneByTrigrammeForCSV($trigramme)
    {
        $query = $this->createQueryBuilder('e')
            ->select('e.trigramme')
            ->addselect('CONCAT(e.prenom, \' \', e.nom)')
            ->addSelect('e.serviceDu')
            ->addSelect('e.statut')
            ->addSelect('e.contact')
            ->where('e.trigramme = :trigramme')
            ->setParameter('trigramme', $trigramme)
            ->getQuery();
        try {
            return $query->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findTeachersOfAModule($module): iterable
    {
        $teachers = [];
        $query = $this->createQueryBuilder('e')
            ->select('e.id as id')
            ->addselect('e.trigramme as trigramme')
            ->addSelect('e.nom as nom')
            ->addSelect('e.prenom as prenom')
            ->join('e.interventions', 'md')
            ->join('md.module', 'm')
            ->where('m.id = :module')
            ->andWhere('md.typeCours LIKE \'CM\'')
            ->groupBy('e.id')
            ->addGroupBy('e.trigramme')
            ->addGroupBy('e.nom')
            ->addGroupBy('e.prenom')
            ->orderBy('e.trigramme')
            ->setParameter('module', $module)
            ->getQuery();
        $teachers['CM'] = $query->getResult();

        $query = $this->createQueryBuilder('e')
            ->select('e.id as id')
            ->addselect('e.trigramme as trigramme')
            ->addSelect('e.nom as nom')
            ->addSelect('e.prenom as prenom')
            ->join('e.interventions', 'md')
            ->join('md.module', 'm')
            ->where('m.id = :module')
            ->andWhere('md.typeCours LIKE \'TD\'')
            ->groupBy('e.id')
            ->addGroupBy('e.trigramme')
            ->addGroupBy('e.nom')
            ->addGroupBy('e.prenom')
            ->orderBy('e.trigramme')
            ->setParameter('module', $module)
            ->getQuery();
        $teachers['TD'] = $query->getResult();

        $query = $this->createQueryBuilder('e')
            ->select('e.id as id')
            ->addselect('e.trigramme as trigramme')
            ->addSelect('e.nom as nom')
            ->addSelect('e.prenom as prenom')
            ->join('e.interventions', 'md')
            ->join('md.module', 'm')
            ->where('m.id = :module')
            ->andWhere('md.typeCours LIKE \'TP\'')
            ->groupBy('e.id')
            ->addGroupBy('e.trigramme')
            ->addGroupBy('e.nom')
            ->addGroupBy('e.prenom')
            ->orderBy('e.trigramme')
            ->setParameter('module', $module)
            ->getQuery();
        $teachers['TP'] = $query->getResult();

        return $teachers;
    }

    public function findAllTeachersByStatus()
    {
        $status[0] = $this->createQueryBuilder('e')
            ->select('count(e.id) as nb')
            ->addSelect('e.statut')
            ->where('e.statut NOT LIKE \'%VAC%\'')
            ->groupBy('e.statut')
            ->orderBy('count(e.id)', 'DESC')
            ->getQuery()
            ->getResult();
        $status[1] = $this->createQueryBuilder('e')
            ->select('count(e.id) as nb')
            ->addSelect('e.statut')
            ->where('e.statut LIKE \'%VAC%\'')
            ->groupBy('e.statut')
            ->orderBy('count(e.id)', 'DESC')
            ->getQuery()
            ->getResult();

        $teachers = [];
        for ($i = 0; $i < sizeof($status); $i++) {
            $teachers[$i] = [];
            $j = 0;
            foreach ($status[$i] as $param) {
                $statut = $param["statut"];
                if ($param["statut"] == "") {
                    $statut = "N/A";
                }

                $result = $this->createQueryBuilder('e')
                    ->where('e.statut LIKE :statut')
                    ->setParameter('statut', $param["statut"])
                    ->orderBy('e.trigramme')
                    ->getQuery()
                    ->getResult();

                if (sizeof($result) > 2) {
                    $teachers[$i][$statut] = [];
                    $teachers[$i][$statut] = $result;
                } else {
                    $teachers[$i]["Autres"][$j] = [];
                    $teachers[$i]["Autres"][$j] = $result;
                    $j++;
                }
            }
        }

        return $teachers;
    }
}
