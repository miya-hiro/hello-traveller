<?php

namespace Tests\Unit\Service;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Services\TwitterApi;
use Tests\TestCase;

class TwitterApiTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        parent::setUp();

        $mock = \Mockery::mock(TwitterOAuth::class);
        $mock->shouldReceive('get')
            ->andReturn((object) ['errors' => []]);

        $this->app->bind(TwitterOAuth::class, function () use ($mock) {
            return $mock;
        });

        $this->sut = new TwitterApi;
        $this->sut->connection = $mock;
    }

    /**
     * @test
     */
    public function getTweets()
    {
        // dd($this->sut);
        $actual = $this->sut->getTweets('東京', 'test');

        $this->assertEquals(false, );
    }
}
