<?php

use ponbiki\radio as rad;

$app->get('/', function () use ($app) {
    
    $page = "test";
    $meta = "blank";
    
    $app->render('home.html.twig', []);
    
})->name('home');
