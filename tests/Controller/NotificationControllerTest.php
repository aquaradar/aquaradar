<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotificationControllerTest extends WebTestCase
{
    public function testNotificationIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/notification');

        $this->assertSame(
                Response::HTTP_OK,
                $client->getResponse()->getStatusCode(),
                sprintf('The %s public URL loads correctly.', $url)
        );
    }
}
