<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends WebTestCase {

    public function testLogin() {
        $url = '/login';

        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertSame(
                Response::HTTP_OK,
                $client->getResponse()->getStatusCode(),
                sprintf('The %s public URL loads correctly.', $url)
        );
    }

}
