<?php

namespace App\Tests\Controller\Api\v1;

use App\Entity\Partner;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PartnerControllerTest extends WebTestCase
{    
    
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $email
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient($email = 'email', $password = 'password')
    {
        $client = static::createClient();
        $client->request('POST', '/api/login_check',
            array(
                '_email' => $email,
                '_password' => $password,
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testGetPartners_Fail()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/partner');
        
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('401', $data['code']);
        $this->assertEquals('JWT Token not found', $data['message']);
    }

    public function testGetPartners_Success()
    {
        $client = $this->createAuthenticatedClient('GOOD_EMAIL', 'GOOD_PASSWORD');

        $client->request('GET', '/api/v1/partner');
        
        //$this->assertEquals(200, $client->getResponse()->getStatusCode());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($data['data']));
    }

}