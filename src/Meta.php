<?php

namespace ponbiki\radio;

/**
 * Remotely grab, parse, and return stream metadata for asynchronous updating of "Now Playing"
 * Class Meta
 * @package ponbiki\radio
 * @license GPLv2
 */

class Meta implements iMeta
{
    /**
     * Remote URL of stream data page
     * @var string Metadata source page URL
     */
    private $metaUrl = 'http://radio.7chan.org:8000/status.xsl';

    /**
     * Remote stream data page as string
     * @var string Remote metadata page loaded into a string
     */
    protected $metaStr;

    /**
     * DOM searchable object of meta page
     * @var object DOM searchable object of data page
     */
    protected $doc;

    /**
     * Connects to remote server and collects page as string
     * @param string $url A string of the remote metadata source address to load
     * @property string $metaStr Sets a string with the contents of the remote URL
     * @throws \PDOException If remote page cannot be reached/loaded throw exception
     */
    protected function getMeta($url)
    {
        try {
            $this->metaStr = \file_get_contents($url);
        } catch (\PDOException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            echo "Unable to contact remote streaming server for metadata." . \PHP_EOL . $code . \PHP_EOL . $message;
            \exit;
        }
    }

    /**
     * Calls getMeta() and loads the resulting string into a DOM searchable object
     * @property object $doc HTML Document as searchable Object
     */
    protected function setMeta()
    {
        $this->getMeta($this->metaUrl);
        $this->doc = new \DOMDocument($this->metaStr);
    }

/**
 * note for later
 * application/ogg
 * audio/mpeg
 */
}