<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends WebTestCase
{    
    
    public function testGetLoginCheck_Fail()
    {
        $client = static::createClient();

        $client->request('POST', '/api/login_check', 
            array(
                '_email'    => 'BAD_EMAIL',
                '_password' => 'BAD_PASSWORD'
            )
        );
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('401', $data['code']);
        $this->assertEquals('Bad credentials', $data['message']);
    }
    
    public function testGetLoginCheck_Success()
    {
        $client = static::createClient(); 

        $client->request('POST', '/api/login_check', 
            array(
                '_email'    => 'GOOD_EMAIL',
                '_password' => 'GOOD_PASSWORD'
            )
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('200', $data['code']);
        $this->assertEquals('Bad credentials', $data['token']);

        //var_dump($data);
    }

    // https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/3-functional-testing.md
}