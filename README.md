# Silex-Memcache

[![Build Status](https://secure.travis-ci.org/mheap/Silex-Predis.png?branch=master)](http://travis-ci.org/mheap/Silex-Predis)

### Requirements

This extension only works with *PHP 7.0+* and *Silex 2*.
[Version 1.0.0](https://github.com/mheap/Silex-Predis/releases/tag/1.0.0) is compatible
with Silex 1.

### Installation

Install with composer:

```bash
composer require mheap/silex-predis
```

### Usage

Before you can use this extension you need to register it with your application. You
specify a server to connect to at this point, as well as any other configuration options

```php
$app->register(new SilexPredis\PredisExtension(), array(
    'predis.server'  => array(
        'host' => '127.0.0.1',
        'port' => 6379
    ),
    'predis.config'  => array(
        'prefix' => 'predis__'
    )
));
```

Once the extension is registered, it'll be available as `$app['predis']`:

```php
$app->get('/', function() use($app) {
    $app['predis']->set('my_value', 'This is an example');
    $value = $app['predis']->get('my_value');
});
```

### Running the tests

You'll need Redis running on port `6379` locally to run the tests. If you don't have
Redis installed you can run `docker-compose up` to run it in a container instead.
