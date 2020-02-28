<?php

namespace Tests\Feature;

use App\User;
use http\Env\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    const API_ROUTE = '/api';

    public function testIndex()
    {
        $response = $this->get(NewsTest::API_ROUTE . '/news');
        $response->assertStatus(200);
    }

    public function testCreation()
    {
        $data = [
            'title' => 'A Title',
            'content' => 'Text here!',
            'user_id' => '1', //todo: delete this
        ];
        $user = factory(User::class)->create([]);
        $this->actingAs($user);
        $this->withoutExceptionHandling();
        $response = $this->post(NewsTest::API_ROUTE . '/news', $data);
        $response->assertStatus(201);
    }

    public function testRead()
    {
        $sampleId = 1;
        $response = $this->get(NewsTest::API_ROUTE . '/news/' . $sampleId);
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
