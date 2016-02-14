<?php


namespace ponbiki\radio;

/**
 * Remotely grab, parse, and return stream metadata for asynchronous updating of "Now Playing"
 * Class Meta
 * @package ponbiki\radio
 * @license GPLv2
 */

interface iMeta
{
    /**
     * Trigger new poll of the stream data and return all meta to the app if available or report off state
     * @return array $this->meta Returns assoc array of all stream metadata
     */
    public function getMeta();
}