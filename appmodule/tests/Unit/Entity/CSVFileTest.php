<?php


namespace App\Tests\Unit\Entity;


use App\Entity\CSVFile;
use PHPUnit\Framework\TestCase;

/**
 * Class CSVFileTest
 * @package App\Tests\Unit\Entity
 */
class CSVFileTest extends TestCase
{
    public function testIsTrue()
    {
        $CSVFile = new CSVFile();

        $CSVFile->setName("file");

        $this->assertTrue($CSVFile->getName() === "file");
    }

    public function testIsFalse()
    {
        $CSVFile = new CSVFile();

        $CSVFile->setName("file");

        $this->assertFalse($CSVFile->getName() === "false");
    }

    public function testIsEmpty()
    {
        $CSVFile = new CSVFile();

        $this->assertEmpty($CSVFile->getName());
    }
}