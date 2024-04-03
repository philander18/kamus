<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'kamus::index');
$routes->get('/kamus', 'kamus::index');
