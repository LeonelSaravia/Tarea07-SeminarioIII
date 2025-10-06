<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->match(['GET', 'POST'], '/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/welcome', 'WelcomeController::index');
$routes->get('/perfil', 'Dashboard::perfil');
$routes->get('/perfil/editar', 'Dashboard::editarPerfil');
$routes->post('/perfil/actualizar', 'Dashboard::actualizarPerfil');

// Rutas para gestión de usuarios
$routes->group('usuario', function($routes) {
    $routes->get('/', 'UsuarioController::index');
    $routes->get('crear', 'UsuarioController::crear');
    $routes->post('guardar', 'UsuarioController::guardar');
    $routes->get('editar/(:num)', 'UsuarioController::editar/$1');
    $routes->post('actualizar/(:num)', 'UsuarioController::actualizar/$1');
    $routes->get('eliminar/(:num)', 'UsuarioController::eliminar/$1');
});

$routes->get('/test', 'Test::index');