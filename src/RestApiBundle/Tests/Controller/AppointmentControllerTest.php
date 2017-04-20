<?php

namespace RestApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use RestApiBundle\Controller\AppointmentController;

class AppointmentControllerTest extends WebTestCase
{
    public function testGetAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/appointment/1');
        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(1, $content['id']);

        $expectedKeys = [
            'id',
            'phone',
            'created_at',
            'modified_at',
            'stylist',
            'slot',
            'customer'
        ];

        foreach($expectedKeys as $key) {
            // check if key exists and is not empty

            $this->assertArrayHasKey($key, $content);
            $this->assertNotEmpty($content[$key]);
        }
    }

    public function testAddAction()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/v1/appointment',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'ACCEPT' => 'application/json'
            ],
            '{"appointmentForm":{"phone":"03021253454", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}'
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(201, $statusCode);
    }

    public function testEditActionSuccess()
    {
        $client = static::createClient();

        $client->request(
            'PUT',
            '/api/v1/appointment/1',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'ACCEPT' => 'application/json'
            ],
            '{"appointmentForm":{"phone":"03021253454", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}'
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(204, $statusCode);
    }

    public function testEditActionNotFoundException()
    {
        $client = static::createClient();

        $client->request(
            'PUT',
            '/api/v1/appointment/1000',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'ACCEPT' => 'application/json'
            ],
            '{"appointmentForm":{"phone":"03021253454", "stylist": "zxcvbnmasdfghjkl", "slot": "1", "customer": "asdfghjklqwertyu"}}'
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(404, $statusCode);
    }

    public function testDeleteActionSuccess()
    {
        $client = static::createClient();

        $client->request(
            'DELETE',
            '/api/v1/appointment/1'
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(204, $statusCode);
    }

    public function testDeleteActionNotFoundException()
    {
        $client = static::createClient();

        $client->request(
            'DELETE',
            '/api/v1/appointment/1000'
        );

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(404, $statusCode);
    }
}