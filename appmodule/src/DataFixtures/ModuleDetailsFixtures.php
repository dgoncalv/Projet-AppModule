<?php

namespace App\DataFixtures;

use App\Entity\ModuleDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModuleDetailsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('36'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('37a'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('37b'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('38'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('39'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('02'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('CM');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('51'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('51'));
        $moduledetails->setNbGroupes(1);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('51'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TD');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('36'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('37a'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('38'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('39'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('46'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('47'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('48'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('49'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('51'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('02'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('03'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('PCo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('36'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('37a'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('38'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('39'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('46'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('47'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('48'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('49'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('51'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('02'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('03'));
        $moduledetails->setNbGroupes(2);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('ECa'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);


        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('36'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('37a'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('38'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('39'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('40'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('41'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('42'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('45'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('46'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('47'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('48'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('49'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('50'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('51'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('02'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        $moduledetails = new ModuleDetails();
        $moduledetails->setSemaine($this->getReference('03'));
        $moduledetails->setNbGroupes(4);
        $moduledetails->setTypeCours('TP');
        $moduledetails->setEnseignant($this->getReference('DMo'));
        $moduledetails->setModule($this->getReference('M1101'));
        $manager->persist($moduledetails);

        // TODO : M1203 -> pour le POST

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            EnseignantFixtures::class,
            ModuleFixtures::class,
            SemaineFixtures::class,
        );
    }
}
