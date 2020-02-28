<?php

namespace Tests;

use traaittPlatform\traaittService;

class ConfiguretraaittServiceTest extends TestCase
{
    public function testConfigureDefaultValues()
    {
        $traaittService = new traaittService();
        $traaittService->configure([]);
        $this->assertEquals([
            'rpcHost'      => 'http://127.0.0.1',
            'rpcPort'      => 8337,
            'rpcPassword'  => 'test',
            'rpcBaseRoute' => '/json_rpc',
        ], $traaittService->config());
    }

    public function testConfigureAllValues()
    {
        $traaittService = new traaittService();
        $traaittService->configure([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ]);

        $this->assertEquals([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ], $traaittService->config());
    }

    public function testConfigureViaConstructor()
    {
        $traaittService = new traaittService([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ]);

        $this->assertEquals([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ], $traaittService->config());
    }

    public function testConfigureDoesntOverwriteOtherVariables()
    {
        $traaittService = new traaittService();
        $traaittService->configure([
            'client' => 'should not be able to set this value',
        ]);

        $this->assertNotEquals($traaittService->client(), 'should not be able to set this value');
    }
}