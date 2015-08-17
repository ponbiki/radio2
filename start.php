<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim([
    'view' => new \Slim\Views\Twig()
]);

// Views
$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserExtensions = [
     new \Slim\Views\TwigExtension()
];

require 'routes.php';

$app->run();