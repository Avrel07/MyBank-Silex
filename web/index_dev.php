<?php

use \Symfony\Component\Debug\Debug;

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = new \Silex\Application();
$app = require __DIR__ . '/../src/app.php';

require __DIR__.'/../config/dev.php';

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array());
})
    ->bind('homepage');

$app->run();

