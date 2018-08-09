<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotificationControllerTest extends WebTestCase
{
    public function testNotificationIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/notification');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
