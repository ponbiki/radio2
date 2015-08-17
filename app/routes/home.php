<?php

use ponbiki\radio as rad;

$app->get('/', function () use ($app) {
    $app->render('home.html.twig');
})->name('home');