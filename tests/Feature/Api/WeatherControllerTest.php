<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @covers \App\Controllers\Api\TwitterController::getWeather
     */
    public function getWeather()
    {
        $responceData = [
            'weather' => [
                [
                    'main' => '',
                    'icon' => '',
                ]
            ]
        ];

        \WeatherApi::shouldReceive('getData')
            ->once()
            ->with(\Mockery::type('string'))
            ->andReturn($responceData);

        $data = ['destination' => '東京'];

        $response = $this->get(route('getWeather', $data));
        $actual = $response->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $actual);
        $this->assertArrayHasKey('icon', $actual);
    }

    /**
     * @test
     * @covers \App\Controllers\Api\TwitterController::getWeather
     */
    public function getWeather_error()
    {
        $responceData =  ['error'];

        \WeatherApi::shouldReceive('getData')
            ->once()
            ->with(\Mockery::type('string'))
            ->andReturn($responceData);

        $data = ['destination' => '東京'];

        $response = $this->get(route('getWeather', $data));

        $response->assertStatus(500);
    }
}
