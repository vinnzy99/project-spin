<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::dologin');
$routes->get('/buktifoto', 'Home::bukti_foto', ['filter' => 'auth']);
$routes->get('/logout', 'Home::logout', ['filter' => 'auth']);
$routes->get('/spin', 'Home::spin2', ['filter' => 'auth']);
$routes->post('/kirim_foto', 'Home::kirimfoto', ['filter' => 'auth']);
$routes->post('/home/updateTurnLeftAndTotalSpin', 'Home::updateTurnLeftAndTotalSpin');
// $routes->get('/register', 'Home::register');


