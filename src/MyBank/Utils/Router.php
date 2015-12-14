<?php

namespace MyBank\Utils;


use Silex\Application;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Yaml\Yaml;

class Router{

    const ROOT_ROUTING_FILE = '/app/resources/routing.yml';

    public static function loadRoutes(Application &$app,$file = null){
        if($file == null) {
            $file_content = file_get_contents(BASE_DIR.self::ROOT_ROUTING_FILE);
        }elseif(file_exists($file)){
            $file_content = file_get_contents($file);
        }else{
            throw new FileNotFoundException($file);
        }

        $routes = Yaml::parse($file_content,true);

        foreach($routes as $key => $route){
            if(array_key_exists('resource',$route)){
                self::loadRoutes($app,BASE_DIR.$route['resource']);
            }else{
                if(array_key_exists('path',$route) && array_key_exists('action',$route)){
                    $app_route = $app->match($route['path'],$route['action'])->bind($key);
                    if(array_key_exists('method',$route)){
                        $app_route->method($route['method']);
                    }
                    if(array_key_exists('values',$route)){
                        foreach($route['values'] as $key => $route_value) {
                            $app_route->value($key,$route_value);
                        }
                    }
                    if(array_key_exists('asserts',$route)){
                        foreach($route['asserts'] as $key => $route_assert) {
                            $app_route->assert($key,$route_assert);
                        }
                    }

                }else{
                    throw new MissingMandatoryParametersException('Path and action parameters are mandatory');
                }
            }
        }
    }

}
