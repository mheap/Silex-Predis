<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new SilexPredis\PredisExtension(), array(
    'predis.server'  => array(
        'host' => '127.0.0.1',
        'port' => 6379
    ),
    'predis.config'  => array(
        'prefix' => 'predis__'
    )
));

$app->get('/', function () use ($app) {
    $app['predis']->set('test', time());
    return 'Redis: "SET" "test" "' . $app['predis']->get('test') . '"';
});

$app->run();
