<?php

use ponbiki\radio as rad;

$app->get('/', function () use ($app) {

    $page = "7chan Radio";
    $meta = "Main Page";

    $app->render('home.html.twig', [
        'page' => $page,
        'meta' => $meta
    ]);
    
})->name('home');
