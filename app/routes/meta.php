<?php

use ponbiki\radio as radio;

$app->get('/meta', function () use ($app) {

    return (new radio\Meta())->getMeta();

});