<?php

use Slim\App;
use Medoo\Medoo;
use Slim\Views\Twig;
use App\Middleware\AuthMiddleware;

return function (App $app) {
  $container = $app->getContainer();

  // view renderer
  // $container['renderer'] = function ($c) {
  //     $settings = $c->get('settings')['renderer'];
  //     return new \Slim\Views\PhpRenderer($settings['template_path']);
  // };

  // View renderer using Twig
  // $container['view'] = function ($c) {
  //     $view = new Twig(__DIR__ . '/../templates', [
  //         'cache' => false, // Set this to true in production for better performance
  //     ]);

  //     return $view;
  // };

  // monolog
  $container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
  };

  // database
  // Database connection using Medoo
  $container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    return new Medoo([
      'database_type' => 'mysql',
      'database_name' => $settings['database'],
      'server' => $settings['host'],
      'username' => $settings['user'],
      'password' => $settings['pass'],
      'charset' => 'utf8mb4',
    ]);
  };

  // View renderer using Twig
  $container['view'] = function ($c) {
    // Path ke direktori templates
    $templatesPath = __DIR__ . '/../templates';

    // Inisialisasi Twig dengan path templates dan konfigurasi tambahan
    $view = new Twig($templatesPath, [
      'cache' => false, // Set this to true in production for better performance
    ]);

    $view->getEnvironment()->addGlobal('session', $_SESSION);


    return $view;
  };

  // Register provider
  $container['flash'] = function () {
    return new \Slim\Flash\Messages();
  };
};
