<?php

namespace Tests\Feature\Api;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TwitterControllerTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut->twitterAuth = \Mockery::mock('overload:'.TwitterOAuth::class, ['123','123','abc','abc']);
        $this->sut->twitterAuth->shouldReceive('get')->andReturn(
            ['statuses' => ['a','b']]
        );
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
dd($response);
        $response->assertStatus(200);
    }
}
