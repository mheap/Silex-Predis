<?php


namespace SilexPredis;

use Silex\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

use Predis\Client;
use Predis\DispatcherLoop;

class PredisExtension implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['predis'] = function () use ($app) {
            $server = isset($app['predis.server']) ? $app['predis.server'] : array();
            $config = isset($app['predis.config']) ? $app['predis.config'] : array();

            return new Client($server, $config);
        };
    }
}
