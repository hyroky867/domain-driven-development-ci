<?php

declare(strict_types=1);

namespace Config\Routes;

use CodeIgniter\Router\RouteCollection;

class Api
{
    public static function make(RouteCollection $routes): RouteCollection
    {
        $routes->get('api/news', 'Api\News\GetAll::exec');
        return $routes;
    }
}
