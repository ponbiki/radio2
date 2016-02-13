<?php


namespace ponbiki\radio;

/**
 * Remotely grab, parse, and return stream metadata for asynchronous updating of "Now Playing"
 * Class Meta
 * @package ponbiki\radio
 * @license GPLv2
 */

class SongInfo implements iSongInfo
{
    /**
     * Remote URL of stream data XSLT
     * @var string Metadata source page URL
     */
    private $metaUrl = 'http://radio.7chan.org:8000/status3.xsl';

    /**
     * Copy of remote XSLT into a string
     * @var string XSLT as a single string
     */
    private $xmlString;

    /**
     * Playing field data from XSLT
     * @var string Artist - Song data
     */
    public $nowPlaying;

    /**
     * Name field data from XSLT
     * @var string Name data
     */
    public $dj;

    /**
     * Listeners field data from XSLT
     * @var int Current listener count
     */
    public $currentListeners;

    /**
     * Peaklisteners field data from XSLT
     * @var int Peak listener count
     */
    public $peakListeners;

    /**
     * Description field data from XSLT
     * @var string DJ set stream description
     */
    public $description;

    /**
     * Genre field data from XSLT
     * @var string DJ set stream genre
     */
    public $genre;

    /**
     * Connects to remote server, and loads XSLT data into a string
     * @property string $this->xmlString Attempts to set $xmlString property
     * @throws \PDOException If unable to connect to remote server, report message and code
     * @return string $this->xmlString If no exception return string of XSLT
     */
    private function getXml($url)
    {
        try {
            $this->xmlString = \file_get_contents($url);
        } catch (\PDOException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            echo "Unable to contact remote streaming server for metadata." . \PHP_EOL . $code . \PHP_EOL . $message;
            \exit;
        }
        return $this->xmlString;
    }

    public function convertString()
    {

    }
}