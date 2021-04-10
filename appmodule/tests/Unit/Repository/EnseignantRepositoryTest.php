<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Enseignant;
use App\Entity\Module;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EnseignantRepositoryTest extends KernelTestCase
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

    public function testFindTeachersOfAModule(){
        $module = $this->entityManager->getRepository(Module::class)->findBy(['PPN'=>'M1101']);
        $teachers = $this->entityManager->getRepository(Enseignant::class)->findTeachersOfAModule($module);

        // Test 1 : the right number of elements are returned
        $this->assertCount(3, $teachers);
        $this->assertCount(2, $teachers['CM']);
        $this->assertCount(4, $teachers['CM'][1]);

        // Test 2 : that it returns the correct form of object
        $this->assertIsIterable($teachers);
        $this->assertIsIterable($teachers['CM']);
        $this->assertIsIterable($teachers['CM'][1]);
        $this->assertIsString($teachers['CM'][1]['trigramme']);
        $this->assertIsString($teachers['CM'][1]['nom']);

        // Test 3 : that they’re in the right order
        $this->assertStringContainsString('DMo', $teachers['TP'][0]['trigramme']);
        $this->assertStringContainsString('ECa', $teachers['TP'][1]['trigramme']);
        $this->assertStringContainsString('PCo', $teachers['TP'][2]['trigramme']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
