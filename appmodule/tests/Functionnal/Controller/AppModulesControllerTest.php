<?php

namespace App\Tests\Functionnal\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AppModulesControllerTest
 * @package App\Tests\Controller
 */
class AppModulesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/AppModules');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
    }

    public function testMaquetteEnseignement()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/AppModules/semestre/2');
        $this->assertResponseIsSuccessful();

        // Test 1 : the agenda section gives a week-by-week schedule of the first semester
        $this->assertSelectorTextContains('table > tbody > tr:first-of-type > th', 'S5');
        $this->assertSelectorTextContains('table > tbody > tr:last-of-type > th', 'S26');

        // Test 2 : the assignement is done by module of the selected semester
        $this->assertSelectorTextContains('div.tab-pane:nth-of-type(2) > div > table > thead > tr:first-of-type > th:nth-of-type(2)', 'SI2');
        $this->assertSelectorTextContains('div.tab-pane:nth-of-type(3) > div > table > thead > tr:first-of-type > th:nth-of-type(2)', 'LAN2');

        // Test 3 : the assignement is done by the type of teaching
        $this->assertSelectorTextContains('table > thead > tr:nth-of-type(3) > th:nth-of-type(1)', 'CM');
        $this->assertSelectorTextContains('table > thead > tr:nth-of-type(3) > th:nth-of-type(2)', 'TD');
        $this->assertSelectorTextContains('table > thead > tr:nth-of-type(3) > th:nth-of-type(3)', 'TP');
        $this->assertSelectorTextContains('table > thead > tr:nth-of-type(3) > th:nth-of-type(4)', 'EV');

        // Test 4 : the responsables of each module is identified
        $this->assertSelectorTextContains('div.tab-pane:nth-of-type(2) > div > table > thead > tr:nth-of-type(2) > th:nth-of-type(2)', 'MRa');
        $this->assertSelectorTextContains('div.tab-pane:nth-of-type(3) > div > table > thead > tr:nth-of-type(2) > th:nth-of-type(2)', 'PCr');

        // Test 5 : it is possible to consult other agenda
        $link = $crawler->filter('a:contains("Semestre")')->eq(0)->link();
        $crawler = $client->click($link);
        $this->assertResponseIsSuccessful();

        // Test 6 : The week's total work hours are visible
        $this->assertSelectorTextContains('table > tbody > tr:first-of-type > th', 'S36');
        $this->assertSelectorTextContains('div.tab-pane:nth-of-type(1) > div > div > table > tbody > tr > th', 'Charge Horaire');
    }

    public function testFicheModule()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/AppModules/module/M1101');
        $this->assertResponseIsSuccessful();

        // Test 1 : le planning de l'agenda est sur la période du semestre
        $this->assertSelectorTextContains('table > tbody > tr:first-of-type > th', 'S36');
        $this->assertSelectorTextContains('table > tbody > tr:last-of-type > th', 'S4');

        // Test 2 : on peut vérifier qu'on est bien sur la bonne page
        $this->assertSelectorTextContains('h4', 'M1101');
        $this->assertSelectorTextContains('h4', 'SI1');

        // Test 3 : on peut identifier le(s) responsable(s) du module
        $this->assertSelectorTextContains('div.col-12 > p:first-of-type', 'PCo');
        $this->assertSelectorTextContains('div.col-12 > p:first-of-type', 'Philippe Coulaud');

        // Test 4 : La répartition se fait par type d'enseignement
        $this->assertSelectorTextContains('table > thead > tr:first-of-type > th:nth-of-type(2)', 'CM');
        $this->assertSelectorTextContains('table > thead > tr:first-of-type > th:nth-of-type(3)', 'TD');
        $this->assertSelectorTextContains('table > thead > tr:first-of-type > th:nth-of-type(4)', 'TP');

        // Test 5 : La répartition se fait aussi par enseignant intervenant dans le cours
        $this->assertSelectorTextContains('table > thead > tr:nth-of-type(3) > th:nth-of-type(1) > span', 'ECa');
        $this->assertSelectorTextContains('table > thead > tr:nth-of-type(3) > th:nth-of-type(2) > span', 'PCo');

        // Test 6 : on peut revenir sur la maquette du semestre correspondant
        $link = $crawler->filter('a:contains("Semestre")')->eq(0)->link();
        $crawler = $client->click($link);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
