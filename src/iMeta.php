<?php


namespace ponbiki\radio;

/**
 * Remotely grab, parse, and return stream metadata for asynchronous updating of "Now Playing"
 * Interface iMeta
 * @package ponbiki\radio
 * @license GPLv2
 */

interface iMeta
{
    /**
     * Remote URL of stream data XSLT
     * @const string Metadata source page URL
     */
    const METAURL = 'http://radio.7chan.org:8000/status3.xsl';

    /**
     * Trigger new poll of the stream data and return all meta to the app if available or report off state
     * @return array $this->meta Returns assoc array of all stream metadata
     */
    public function getMeta();
}