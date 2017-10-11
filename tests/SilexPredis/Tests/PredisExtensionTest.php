<?php

namespace SilexPredis\Tests\Extension;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use SilexPredis\PredisExtension;

use Predis\Client;
use Predis\Connection\ConnectionException;

use PHPUnit\Framework\TestCase;

class PredisExtensionTest extends TestCase
{
    public function testRegister()
    {
        $app = new Application();
        $app->register(new PredisExtension(), array(
            'predis.config'  => array(
                'prefix' => 'predis__'
            )
        ));

        $this->assertInstanceOf(Client::class, $app['predis']);
        $this->assertSame('predis__', $app['predis']->getOptions()->prefix->getPrefix());
    }

    public function testFailedConnection()
    {
        $this->expectException(ConnectionException::class);

        $app = new Application();
        $app->register(new PredisExtension(), array(
            'predis.server'  => array(
                'port' => 0,
                'host' => '0.0.0.0'
            )
        ));

        $app['predis']->connect();
    }

    public function testSetAndGet()
    {
        $app = new Application();
        $app->register(new PredisExtension(), array(
            'predis.config'  => array(
                'prefix' => 'predis__'
            )
        ));

        $testvalue = 'my_test_value';
        $app['predis']->set('my_test_key', $testvalue);
        $this->assertSame($testvalue, $app['predis']->get('my_test_key'));
    }
}
