<?php


namespace App\Tests\Unit\Entity;


use App\Entity\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @package App\Tests\Unit\Entity
 */
class ModuleTest extends TestCase
{
    public function testIsTrue()
    {
        $module = new Module();

        $module->setPPN("M1101");
        $module->setIntitule("SI1 Introduction aux systèmes informatiques");

        $this->assertTrue($module->getPPN() === "M1101");
        $this->assertTrue($module->getIntitule() === "SI1 Introduction aux systèmes informatiques");
    }

    public function testIsFalse()
    {
        $module = new Module();

        $module->setPPN("M1101");
        $module->setIntitule("SI1 Introduction aux systèmes informatiques");

        $this->assertFalse($module->getPPN() === "false");
        $this->assertFalse($module->getIntitule() === "false");
    }

    public function testIsEmpty()
    {
        $module = new Module();

        $this->assertEmpty($module->getPPN());
        $this->assertEmpty($module->getIntitule());
    }
}