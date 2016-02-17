<?php

use ponbiki\radio as radio;

$app->get('/meta', function () use ($app) {

    print("<ul>");
    foreach ((new radio\Meta())->getMeta() as $key => $value) {
        print("<li>$key -- $value </li>");
     }
    print("</ul>");

});