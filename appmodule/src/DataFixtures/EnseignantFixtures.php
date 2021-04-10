<?php

namespace App\DataFixtures;

use App\Entity\Enseignant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnseignantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $enseignant = new Enseignant();
        $enseignant->setTrigramme('ALa');
        $enseignant->setPrenom('Annick');
        $enseignant->setNom('Lassus');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SEC');
        $manager->persist($enseignant);
        $this->addReference("ALa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('CMa');
        $enseignant->setPrenom('Céline');
        $enseignant->setNom('Marteau');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SEC');
        $manager->persist($enseignant);
        $this->addReference("CMa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('FGo');
        $enseignant->setPrenom('Frédérique');
        $enseignant->setNom('Gobert');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SEC');
        $manager->persist($enseignant);
        $this->addReference("FGo", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('PCo');
        $enseignant->setPrenom('Philippe');
        $enseignant->setNom('Coulaud');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SEC');
        $manager->persist($enseignant);
        $this->addReference("PCo", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('PCr');
        $enseignant->setPrenom('Philippe');
        $enseignant->setNom('Crottereau');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SEC');
        $manager->persist($enseignant);
        $this->addReference("PCr", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('ECa');
        $enseignant->setPrenom('Etienne');
        $enseignant->setNom('Carnovali');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SEC');
        $manager->persist($enseignant);
        $this->addReference("ECa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('ADo');
        $enseignant->setPrenom('Antoine');
        $enseignant->setNom('Doucet');
        $enseignant->setServiceDu(0);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("ADo", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('CFa');
        $enseignant->setPrenom('Cyril');
        $enseignant->setNom('Faucher');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("CFa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('FAB');
        $enseignant->setPrenom('Farid');
        $enseignant->setNom('Ammar-Boudjelal');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('');
        $manager->persist($enseignant);
        $this->addReference("FAB", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('JMa');
        $enseignant->setPrenom('Jamal');
        $enseignant->setNom('Malki');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("JMa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('MHB');
        $enseignant->setPrenom('Marie-Hélène');
        $enseignant->setNom('Baudoux');
        $enseignant->setServiceDu(0);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("MHB", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('MRa');
        $enseignant->setPrenom('Mourad');
        $enseignant->setNom('Rabah');
        $enseignant->setServiceDu(153.6);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("MRa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('PGo');
        $enseignant->setPrenom('Petra');
        $enseignant->setNom('Gomez');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("PGo", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('RC');
        $enseignant->setPrenom('Ronan');
        $enseignant->setNom('Champagnat');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("RC", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('SMa');
        $enseignant->setPrenom('Sylvain');
        $enseignant->setNom('Marchand');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("SMa", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('YGD');
        $enseignant->setPrenom('Yacine');
        $enseignant->setNom('Ghamri-Doudane');
        $enseignant->setServiceDu(192);
        $enseignant->setStatut('');
        $manager->persist($enseignant);
        $this->addReference("YGD", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('PJo');
        $enseignant->setPrenom('Pauline');
        $enseignant->setNom('Jousseaume');
        $enseignant->setServiceDu(384);
        $enseignant->setStatut('SUP');
        $manager->persist($enseignant);
        $this->addReference("PJo", $enseignant);

        $enseignant = new Enseignant();
        $enseignant->setTrigramme('DMo');
        $enseignant->setPrenom('Damien');
        $enseignant->setNom('Mondou');
        $enseignant->setServiceDu(176);
        $enseignant->setStatut('ATER');
        $manager->persist($enseignant);
        $this->addReference("DMo", $enseignant);

        $manager->flush();
    }
}
