<?php

namespace Tests\Unit\Service;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Services\TwitterApi;
use Tests\TestCase;

class TwitterApiTest extends TestCase
{
    private $sut;
    private $property;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new TwitterApi;

        //privateプロパティへのアクセスを可能に
        $reflectionClass = new \ReflectionClass(get_class($this->sut));
        $this->property = $reflectionClass->getProperty('connection');
        $this->property->setAccessible(true);
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

        //privateプロパティへのアクセスを可能に
        $this->property->setValue($this->sut, $mock);

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

        //privateプロパティへのアクセスを可能に
        $this->property->setValue($this->sut, $mock);

        $actual = $this->sut->getTweets('東京', 'test');

        $this->assertEquals(false, $actual);
    }
}
