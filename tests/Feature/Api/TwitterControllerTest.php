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
        $data = [
            'destination' => '東京'
        ];

        $response = $this->get('api/tweets', $data);

        $response->assertStatus(200);
    }
}
