<?php

declare(strict_types=1);

namespace Config\Routes;

use CodeIgniter\Router\RouteCollection;

class Web
{
    public static function make(RouteCollection $routes): RouteCollection
    {
        $routes->get('/', 'Home::index');

        $routes->get('news', 'Web\News\GetAll::exec');
        $routes->get('news/create', 'Web\News\ShowCreate::exec');
        $routes->post('news/create', 'Web\News\Create::exec');
        $routes->get('news/(:segment)', 'Web\News\SearchBySlug::exec/$1');

        return $routes;
    }
}
