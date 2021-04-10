<?php


namespace App\Tests\Functionnal\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ModulesControllerTest
 * @package App\Tests\Controller
 */
class ModulesControllerTest extends WebTestCase
{
    /**
     * Test de la route import_modules
     */
    public function testRouteImportModules()
    {
        $client = static::createClient();

        $client->request('GET', '/AppModules/import_modules');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('legend', 'Importer un CSV');
    }

}