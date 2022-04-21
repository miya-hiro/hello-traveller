<?php

namespace Tests\Unit\Service;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Services\TwitterApi;
use Tests\TestCase;

class TwitterApiTest extends TestCase
{
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

        $sut = new TwitterApi($mock);

        $actual = $sut->getTweets('東京', 'test');

        $this->assertCount(2, $actual);

        //形が欲しい形かチェックする
    }

    /**
     * @test
     */
    public function getTweets_error()
    {
        $mock = \Mockery::mock(TwitterOAuth::class);
        $mock->shouldReceive('get')
            ->andReturn((object) ['errors' => []]);

        $sut = new TwitterApi($mock);

        $actual = $sut->getTweets('東京', 'test');

        $this->assertEquals(false, $actual);
    }
}
