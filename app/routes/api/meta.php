<?php

use ponbiki\radio as radio;

$app->get('/api/meta', function () use ($app) {

    /**
     * @var string Loads the results of "now playing" meta into a JSON string
     */
    $metaJson = json_encode((new radio\Meta())->getMeta());

    /**
     * 
     * @return string Returns messages as JSON
     */
    print($metaJson);

});