<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Controller\UserController;
use App\Controller\AdminController;
use App\Controller\ProductController;
use App\Middleware\AuthMiddleware;

return function (App $app) {

  // Authententicate
  $app->get('/formLogin', UserController::class . ':formLogin');
  $app->post('/loginProses', UserController::class . ':login');
  $app->get('/formRegister', UserController::class . ':formRegister');
  $app->post('/registerProses', UserController::class . ':register');
  $app->get('/logoutProses', UserController::class . ':logout');
  $app->get('/accountSetting', UserController::class . ':accountSetting');
  $app->post('/uploadProfilePicture', UserController::class . ':uploadProfilePicture');
  $app->post('/editProfile/{id}', UserController::class . ':editProfile');


  // product
  $app->get('/index', ProductController::class . ':index');
  $app->get('/products', ProductController::class . ':showProducts')->add(new AuthMiddleware());
  $app->post('/products/add', ProductController::class . ':add');
  $app->post('/products/edit/{id}', ProductController::class . ':edit');
  $app->post('/products/delete/{id}', ProductController::class . ':delete');
  $app->get('/cart', ProductController::class . ':cart');
};
