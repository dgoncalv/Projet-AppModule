<?php


namespace App\Tests\Unit\Entity;


use App\Entity\Enseignant;
use App\Entity\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class EnseignantTest
 * @package App\Tests\Unit\Entity
 */
class EnseignantTest extends TestCase
{
    public function testIsTrue()
    {
        $enseignant = new Enseignant();
        $module = new Module();

        $enseignant->setTrigramme("ALa");
        $enseignant->setPrenom("Annick");
        $enseignant->setNom("Lassus");
        $enseignant->setServiceDu(250.0);
        $enseignant->setStatut("SEC");
        $enseignant->setContact("0000000000");
        $enseignant->addModule($module);

        $this->assertTrue($enseignant->getTrigramme() === "ALa");
        $this->assertTrue($enseignant->getPrenom() === "Annick");
        $this->assertTrue($enseignant->getNom() === "Lassus");
        $this->assertTrue($enseignant->getServiceDu() === 250.0);
        $this->assertTrue($enseignant->getStatut() === "SEC");
        $this->assertTrue($enseignant->getContact() === "0000000000");
        $this->assertTrue($enseignant->getModules()->contains($module));
    }

    public function testIsFalse()
    {
        $enseignant = new Enseignant();
        $module = new Module();

        $enseignant->setTrigramme("ALa");
        $enseignant->setPrenom("Annick");
        $enseignant->setNom("Lassus");
        $enseignant->setServiceDu(250.0);
        $enseignant->setStatut("SEC");
        $enseignant->setContact("0000000000");
        $enseignant->addModule($module);

        $this->assertFalse($enseignant->getTrigramme() === "false");
        $this->assertFalse($enseignant->getPrenom() === "false");
        $this->assertFalse($enseignant->getNom() === "false");
        $this->assertFalse($enseignant->getServiceDu() === 0);
        $this->assertFalse($enseignant->getStatut() === "false");
        $this->assertFalse($enseignant->getContact() === "false");
        $this->assertFalse($enseignant->getModules()->contains(new Module()));
    }

    public function testIsEmpty()
    {
        $enseignant = new Enseignant();

        $this->assertEmpty($enseignant->getTrigramme());
        $this->assertEmpty($enseignant->getPrenom());
        $this->assertEmpty($enseignant->getNom());
        $this->assertEmpty($enseignant->getServiceDu());
        $this->assertEmpty($enseignant->getStatut());
        $this->assertEmpty($enseignant->getContact());
        $this->assertEmpty($enseignant->getModules());
    }
}