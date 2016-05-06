<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Controller\TestController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
       
    public function testNumber()
    {
        $client = static::createClient();
        
        $crawler = $client->request("GET", "app_dev.php/lucky/number/8");
        
        $this->assertGreaterThan(0,  $crawler->filter('html:contains("nuuumber")')->count());
    }
}