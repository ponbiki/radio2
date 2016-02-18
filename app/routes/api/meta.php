<?php

use ponbiki\radio as radio;

$app->get('/api/meta', function () use ($app) {

    /**
     * @var string Loads the results of "now playing" meta into a JSON string
     */
    $metaJson = json_encode((new radio\Meta())->getMeta());

    /**
     * Sets content type header and
     * returns meta as JSON for API calls
     * @return string Returns messages as JSON
     */
    $app->response->headers->set('Content-Type', 'application/json');
    print($metaJson.\PHP_EOL);

});