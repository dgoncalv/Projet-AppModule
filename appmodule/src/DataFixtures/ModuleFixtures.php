<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //$product = new Product();
        //$manager->persist($module);

        $module = new Module();
        $module->setPPN('M1101');
        $module->setIntitule('SI1 Introduction aux systèmes informatiques');
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1101", $module);

        $module = new Module();
        $module->setPPN('M1102');
        $module->setIntitule("AP1.1 Introduction à l'algorithmique et à la programmation");
        $module->addResponsable($this->getReference('RC'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1102", $module);

        $module = new Module();
        $module->setPPN('M1103');
        $module->setIntitule('AP1.2 Structures de données et algorithmes fondamentaux');
        $module->addResponsable($this->getReference('FAB'));
        $manager->persist($module);
        $this->addReference("M1103", $module);

        $module = new Module();
        $module->setPPN('M1104');
        $module->setIntitule('BD1 Introduction aux bases de données');
        $module->addResponsable($this->getReference('CFa'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1104", $module);

        $module = new Module();
        $module->setPPN('M1105');
        $module->setIntitule("CDIN1 Conception de documents et d'interfaces numériques");
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1105", $module);

        $module = new Module();
        $module->setPPN('M1106');
        $module->setIntitule('PTS1 Projet tutoré -- Découverte');
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1106", $module);

        $module = new Module();
        $module->setPPN('M1201');
        $module->setIntitule('MD1 Mathématiques discrètes');
        $module->addResponsable($this->getReference('PCr'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1201", $module);

        $module = new Module();
        $module->setPPN('M1202');
        $module->setIntitule('AL1 Algèbre linéaire');
        $module->addResponsable($this->getReference('CMa'));
        $manager->persist($module);
        $this->addReference("M1202", $module);

        $module = new Module();
        $module->setPPN('M1203');
        $module->setIntitule('ECO1 Environnement économique');
        $module->addResponsable($this->getReference('FGo'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1203", $module);

        $module = new Module();
        $module->setPPN('M1204');
        $module->setIntitule('ORGA1 Fonctionnement des organisations');
        $module->addResponsable($this->getReference('FGo'));
        $manager->persist($module);
        $this->addReference("M1204", $module);

        $module = new Module();
        $module->setPPN('M1205');
        $module->setIntitule('EC1 Expression-Communication -- Fondamentaux de la communication');
        $module->addResponsable($this->getReference('PCr'));
        $manager->persist($module);
        $this->addReference("M1205", $module);

        $module = new Module();
        $module->setPPN('M1206');
        $module->setIntitule('ANG1 Anglais et Informatique');
        $module->addResponsable($this->getReference('PJo'));
        $manager->persist($module);
        $this->addReference("M1206", $module);

        $module = new Module();
        $module->setPPN('M1207');
        $module->setIntitule('PPP1 Projet personnel et professionnel -- Connaître le monde professionnel');
        $module->addResponsable($this->getReference('FGo'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M1207", $module);

        $module = new Module();
        $module->setPPN('M2101');
        $module->setIntitule("SI2 Architecture et programmation des mécanismes de base d'un système informatique");
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2101", $module);

        $module = new Module();
        $module->setPPN('M2102');
        $module->setIntitule('RES2 Architecture des réseaux');
        $module->addResponsable($this->getReference('MRa'));
        $manager->persist($module);
        $this->addReference("M2102", $module);

        $module = new Module();
        $module->setPPN('M2103');
        $module->setIntitule('POO2 Bases de la programmation orientée objet');
        $module->addResponsable($this->getReference('PGo'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2103", $module);

        $module = new Module();
        $module->setPPN('M2104');
        $module->setIntitule('BCOO2 Bases de la conception orientée objet');
        $module->addResponsable($this->getReference('ECa'));
        $manager->persist($module);
        $this->addReference("M2104", $module);

        $module = new Module();
        $module->setPPN('M2105');
        $module->setIntitule('IHM2 Introduction aux interfaces homme-machine');
        $module->addResponsable($this->getReference('RC'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2105", $module);

        $module = new Module();
        $module->setPPN('M2106');
        $module->setIntitule('BD2 Programmation et administration des bases de données');
        $module->addResponsable($this->getReference('JMa'));
        $manager->persist($module);
        $this->addReference("M2106", $module);

        $module = new Module();
        $module->setPPN('M2107');
        $module->setIntitule('PTS2 Projet tutoré -- Description et planification de projet');
        $module->addResponsable($this->getReference('SMa'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2107", $module);

        $module = new Module();
        $module->setPPN('M2201');
        $module->setIntitule('LAN2 Graphes et langages');
        $module->addResponsable($this->getReference('CMa'));
        $manager->persist($module);
        $this->addReference("M2201", $module);

        $module = new Module();
        $module->setPPN('M2202');
        $module->setIntitule('AMN2 Analyse et méthodes numériques');
        $module->addResponsable($this->getReference('PCr'));
        $manager->persist($module);
        $this->addReference("M2202", $module);

        $module = new Module();
        $module->setPPN('M2203');
        $module->setIntitule('ECJS2 Environnement comptable, financier juridique et social');
        $module->addResponsable($this->getReference('FGo'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2203", $module);

        $module = new Module();
        $module->setPPN('M2204');
        $module->setIntitule('GPI2 Gestion de projet informatique');
        $module->addResponsable($this->getReference('ALa'));
        $manager->persist($module);
        $this->addReference("M2204", $module);

        $module = new Module();
        $module->setPPN('M2205');
        $module->setIntitule('EC2 Expression-Communication -- Communication, information et argumentation');
        $module->addResponsable($this->getReference('PCr'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2205", $module);

        $module = new Module();
        $module->setPPN('M2206');
        $module->setIntitule('ANG2 Communiquer en anglais');
        $module->addResponsable($this->getReference('PJo'));
        $manager->persist($module);
        $this->addReference("M2206", $module);

        $module = new Module();
        $module->setPPN('M2207');
        $module->setIntitule('PPP2 Projet personnel et professionnel -- Identifier ses compétences');
        $module->addResponsable($this->getReference('FGo'));
        $module->addResponsable($this->getReference('PCo'));
        $manager->persist($module);
        $this->addReference("M2207", $module);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            EnseignantFixtures::class,
        );
    }
}
