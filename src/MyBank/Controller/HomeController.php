<?php

namespace MyBank\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class HomeController{

    public function indexAction(Request $request, Application $app)
    {
        $app['db']->fetchAll('SELECT * FROM table');
        return $app['twig']->render('index.twig', array());
    }
}