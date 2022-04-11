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

        $this->sut = new TwitterApi;
    }

    /**
     * @test
     */
    public function getTweets()
    {
        $mock = \Mockery::mock(TwitterOAuth::class);
        $mock->shouldReceive('get')
            ->andReturn((object) [
                'statuses' =>
                [
                    (object)['data1'],
                    (object)['data2']
                ]
            ]);

        $this->sut->connection = $mock;

        $actual = $this->sut->getTweets('東京', 'test');

        $this->assertCount(2, $actual);
    }

    /**
     * @test
     */
    public function getTweets_error()
    {
        $mock = \Mockery::mock(TwitterOAuth::class);
        $mock->shouldReceive('get')
            ->andReturn((object) ['errors' => []]);

        $this->sut->connection = $mock;

        $actual = $this->sut->getTweets('東京', 'test');

        $this->assertEquals(false, $actual);
    }
}
