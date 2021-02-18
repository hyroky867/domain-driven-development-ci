<?php

declare(strict_types=1);

namespace Config\Routes;

use CodeIgniter\Router\RouteCollection;

class Api
{
    public static function make(RouteCollection $routes): RouteCollection
    {
        $routes->get('api/news', 'Api\News\GetAll::exec');
        $routes->get('api/news/(:num)', 'Api\News\Show::exec/$1');
        $routes->post('api/news', 'Api\News\Create::exec');
        $routes->put('api/news/(:num)', 'Api\News\Update::exec/$1');
        return $routes;
    }
}
