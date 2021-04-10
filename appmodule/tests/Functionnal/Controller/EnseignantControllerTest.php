<?php


namespace App\Tests\Functionnal\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class EnseignantControllerTest
 * @package App\Tests\Controller
 */
class EnseignantControllerTest extends WebTestCase
{
    /**
     * Test de la route import_enseignants
     */
    public function testRouteImportEnseignants()
    {
        $client = static::createClient();

        $client->request('GET', '/AppModules/import_enseignants');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('legend', 'Importer un CSV');
    }

}