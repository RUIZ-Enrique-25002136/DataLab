<?php

use App\Core\RouteCollection;
use App\Controller\{AccountController,AuthController,PasswordController,HomeController,MemberController};

$routes = new RouteCollection();    $routes->get('/',             [HomeController::class, 'index'], 'Accueil');
$routes->get('/legal-notice', [HomeController::class, 'legalNotice'], 'Mentions légales');
$routes->get('/sitemap',      [HomeController::class, 'sitemap'], 'Plan du site');
$routes->get('/login',     [AuthController::class, 'loginForm'], 'Connexion');
$routes->post('/login',    [AuthController::class, 'login']);
$routes->get('/register',  [AuthController::class, 'registerForm'], 'Inscription');
$routes->post('/register', [AuthController::class, 'register']);
$routes->get('/logout',    [AuthController::class, 'logout']);
$routes->post('/logout',   [AuthController::class, 'logout']);
$routes->get('/verify',    [AuthController::class, 'verify']);
$routes->get('/forgot-password',  [PasswordController::class, 'forgot'], 'Mot de passe oublié');
$routes->post('/forgot-password', [PasswordController::class, 'forgot']);
$routes->get('/reset-password',   [PasswordController::class, 'reset']);
$routes->post('/reset-password',  [PasswordController::class, 'reset']);
$routes->get('/account',         [AccountController::class, 'show'], 'Mon compte');
$routes->post('/account',        [AccountController::class, 'updateLogin']);
$routes->post('/account/delete', [AccountController::class, 'delete']);
$routes->get('/members', [MemberController::class, 'index'], 'Membres');
return $routes;
