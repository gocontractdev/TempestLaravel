<?php

namespace Tests\Feature;

use App\News;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    const API_ROUTE = '/api';

    const DRIVER = 'api';

    /**
     * testIndex checks the GET route for /news
     * part of the NewsController
     */
    public function testIndex()
    {
        $testUser = factory(User::class)->create([]);

        $response = $this->actingAs($testUser, NewsTest::DRIVER)
            ->get(NewsTest::API_ROUTE . '/news');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([ 'data', 'links', 'meta',]);
    }

    public function testStore()
    {
        $monitorId =  rand(1, 100);
        $testUser = factory(User::class)->create(['id' => $monitorId,]);
        $faker = Factory::create();
        $data = [
            'title' => $faker->name,
            'content' => $faker->text,
        ];

        $response = $this->actingAs($testUser, NewsTest::DRIVER)
            ->withoutEvents() // disable events on test
            ->post(NewsTest::API_ROUTE . '/news',  $data);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([
           'data' => [
                'title',
                'content',
                'user_id',
                'created_at',
           ]
        ]);
        $response->assertJsonFragment([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $monitorId,
        ]);
    }

    public function testRead()
    {
        $monitorId =  rand(1, 100);
        $testUser = factory(User::class)->create();
        $fakedNews = factory(News::class)->create([
            'id' => $monitorId,
            'user_id' => $testUser->id,
        ]);
        $response = $this->actingAs($testUser, NewsTest::DRIVER)
            ->get(NewsTest::API_ROUTE . '/news/' . $monitorId);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'title',
                'content',
                'user_id',
                'created_at',
            ]
        ]);
        $response->assertJsonFragment([
            'title' => $fakedNews->title,
            'content' => $fakedNews->content,
        ]);
    }

    public function testUpdate()
    {
        // todo: delete duplicates
        $monitorId =  rand(1, 100);
        $testUser = factory(User::class)->create();
        $fakedNews = factory(News::class)->create([
            'id' => $monitorId,
            'user_id' => $testUser->id,
        ]);

        $faker = Factory::create();
        $data = [
            'title' => $faker->name,
            'content' => $faker->text,
        ];

        $response = $this->actingAs($testUser, NewsTest::DRIVER)
            ->put(NewsTest::API_ROUTE . '/news/' . $monitorId, $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'content',
                'user_id',
                'created_at',
            ]
        ]);
        $response->assertJsonFragment([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => strval($testUser->id),
        ]);
    }

    public function testDelete()
    {
        // todo: delete duplicates
        $monitorId =  rand(1, 100);
        $testUser = factory(User::class)->create();
        $fakedNews = factory(News::class)->create([
            'id' => $monitorId,
            'user_id' => $testUser->id,
        ]);

        $response = $this->actingAs($testUser, NewsTest::DRIVER)
            ->delete(NewsTest::API_ROUTE . '/news/' . $monitorId);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'status',
            ]
        ]);
        $response->assertJsonFragment([
            'status' => true,
        ]);
    }

    /**
     * use as alternative to test if header tokens work
     *
     * @deprecated
     * @param $user
     * @return array
     */
    private function generateHeaderArray($user)
    {
        return [
            'Authorization' => 'Bearer ' . $user->api_token,
        ];
    }
}
