<?php

use \Symfony\Component\Debug\Debug;

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = new \Silex\Application();
$app = require __DIR__ . '/../app/app.php';

require __DIR__.'/../config/dev.php';

//$app->get('/', 'MyBank\\Controller\\HomeController::indexAction');

\MyBank\Utils\Router::loadRoutes($app);


$app->run();

