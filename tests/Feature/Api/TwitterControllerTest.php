<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TwitterControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @covers \App\Controllers\Api\TwitterController::getTweets
     */
    public function getTweets()
    {
        $responceData = [
            ['statuses' => ['a', 'b']]
        ];

        \TwitterApi::shouldReceive('getTweets')
            ->times(2)
            // ->with(\Mockery::on(function ($argument) {
            //     $this->assertIsString($argument[0]);
            //     $this->assertIsString($argument[1]);

            //     return true;
            // }))
            ->andReturn($responceData);

        $data = [
            'destination' => '東京',
        ];

        $response = $this->get(route('getTweets', $data));
        $actual = $response->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('weather', $actual);
        $this->assertArrayHasKey('food', $actual);
    }

    /**
     * @test
     * @covers \App\Controllers\Api\TwitterController::getTweets
     */
    public function getTweets_error()
    {
        \TwitterApi::shouldReceive('getTweets')
            ->times(2)
            ->andReturn(false);

        $data = [
            'destination' => '東京',
        ];

        $response = $this->get(route('getTweets', $data));

        $response->assertStatus(500);
    }
}
