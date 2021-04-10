<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Module;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ModuleRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindModulesOfASemester(){
        $semester = $this->entityManager->getRepository(Module::class)->findModulesOfASemester(2);

        // Test 1 : the right number of elements are returned
        $this->assertCount(2, $semester);
        $this->assertCount(7, $semester['UE1']);
        $this->assertCount(4, $semester['UE1'][1]);

        // Test 2 : that it returns the correct form of object
        $this->assertIsIterable($semester);
        $this->assertIsIterable($semester['UE1']);
        $this->assertIsIterable($semester['UE2'][1]);
        $this->assertIsString($semester['UE2'][1]['PPN']);
        $this->assertIsString($semester['UE2'][1]['responsables']);

        // Test 3 : that they’re in the right order
        $this->assertStringContainsString('M2101',$semester['UE1'][0]['PPN']);
        $this->assertStringContainsString('M2102',$semester['UE1'][1]['PPN']);
        $this->assertStringContainsString('M2103',$semester['UE1'][2]['PPN']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
