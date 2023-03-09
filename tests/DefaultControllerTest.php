<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->createClient();
        $client->request('GET', '/default');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.testh3', 'TRUE');
    }
}
