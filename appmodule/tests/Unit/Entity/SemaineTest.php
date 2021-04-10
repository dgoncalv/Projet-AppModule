<?php


namespace App\Tests\Unit\Entity;


use App\Entity\Module;
use App\Entity\Semaine;
use PHPUnit\Framework\TestCase;

/**
 * Class SemaineTest
 * @package App\Tests\Unit\Entity
 */
class SemaineTest extends TestCase
{
    public function testIsTrue()
    {
        $semaine = new Semaine();
        $module = new Module();

        $semaine->setSemaine(1.0);
        $semaine->setCM(1.0);
        $semaine->setTD(1.0);
        $semaine->setTP(1.0);
        $semaine->setSurveillances(1.0);
        $semaine->setCharges(1.0);
        $semaine->setCommentaires("commentaire");
        $semaine->setModule($module);

        $this->assertTrue($semaine->getSemaine() === 1.0);
        $this->assertTrue($semaine->getCM() === 1.0);
        $this->assertTrue($semaine->getTD() === 1.0);
        $this->assertTrue($semaine->getTP() === 1.0);
        $this->assertTrue($semaine->getSurveillances() === 1.0);
        $this->assertTrue($semaine->getCharges() === 1.0);
        $this->assertTrue($semaine->getCommentaires() === "commentaire");
        $this->assertTrue($semaine->getModule() === $module);
    }

    public function testIsFalse()
    {
        $semaine = new Semaine();
        $module = new Module();

        $semaine->setSemaine(1.0);
        $semaine->setCM(1.0);
        $semaine->setTD(1.0);
        $semaine->setTP(1.0);
        $semaine->setSurveillances(1.0);
        $semaine->setCharges(1.0);
        $semaine->setCommentaires("commentaire");
        $semaine->setModule($module);

        $this->assertFalse($semaine->getSemaine() === 2.0);
        $this->assertFalse($semaine->getCM() === 2.0);
        $this->assertFalse($semaine->getTD() === 2.0);
        $this->assertFalse($semaine->getTP() === 2.0);
        $this->assertFalse($semaine->getSurveillances() === 2.0);
        $this->assertFalse($semaine->getCharges() === 2.0);
        $this->assertFalse($semaine->getCommentaires() === "false");
        $this->assertFalse($semaine->getModule() === new Module());
    }

    public function testIsEmpty()
    {
        $semaine = new Semaine();

        $this->assertEmpty($semaine->getSemaine());
        $this->assertEmpty($semaine->getCM());
        $this->assertEmpty($semaine->getTD());
        $this->assertEmpty($semaine->getTP());
        $this->assertEmpty($semaine->getSurveillances());
        $this->assertEmpty($semaine->getCharges());
        $this->assertEmpty($semaine->getCommentaires());
        $this->assertEmpty($semaine->getModule());
    }
}