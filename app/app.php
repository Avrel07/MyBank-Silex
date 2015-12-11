<?php
use \Silex\Application;
use \Silex\Provider\HttpFragmentServiceProvider;
use \Silex\Provider\ServiceControllerServiceProvider;
use \Silex\Provider\TwigServiceProvider;
use \Silex\Provider\UrlGeneratorServiceProvider;
use \Symfony\Component\Routing;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());





return $app;
