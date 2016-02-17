<?php

use ponbiki\radio as radio;

$app->get('/meta', function () use ($app) {

    /**
     * @var array Loads the results of "now playing" meta into a local array
     */
    $metaArray = (new radio\Meta())->getMeta();

    /**
     * Checks status and returns meta or off error items
     * @return mixed Returns messages as li
     */
    if ($metaArray['status'] === "off") {
        print("<li>&#9785; OFF AIR &#9785;</li>");
    } elseif ($metaArray['status'] === "on") {
        print("<li>DJ: {$metaArray['dj']}</li>");
        print("<li>Playing: {$metaArray['playing']}</li>");
        print("<li>Listeners: {$metaArray['listeners']}</li>");
    } else {
        print("Your mama so fat, she caused a server error!");
    }

});