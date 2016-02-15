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
     * Object representation of remote XSLT
     * @var object XML object
     */
    private $xmlObject;

    /**
     * Indicates if radio is live streaming
     * @var boolean TRUE if DJ is live else FALSE
     */
    private $onAir = \FALSE;
    /**
     * Copy of remote XSLT into a string
     * @var string XSLT as a single string
     */
    private $nowPlaying;

    /**
     * Name field data from XSLT
     * @var string Name data
     */
    private $dj;

    /**
     * Listeners field data from XSLT
     * @var int Current listener count
     */
    private $currentListeners;

    /**
     * Peaklisteners field data from XSLT
     * @var int Peak listener count
     */
    private $peakListeners;

    /**
     * Description field data from XSLT
     * @var string DJ set stream description
     */
    private $description;

    /**
     * Genre field data from XSLT
     * @var string DJ set stream genre
     */
    private $genre;

    /**
     * Array for holding the individual metadata properties
     * @var array Metadata container
     */
    public $meta = [];


    /**
     * Connects to remote server, loads XSLT data into a string, and converts to object
     * @param string $url The URL of the remote server's XSLT data page
     * @throws \Exception If unable to connect to remote server, report message and code
     * @var object $this->xmlObject XSLT represented as an object
     * @return object $this->xmlObject Returns converted XML as PHP object
     */
    private function getXml($url)
    {
        try {
            $xmlString = \file_get_contents($url);
        } catch (\Exception $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
            echo "Unable to contact remote streaming server for metadata." . \PHP_EOL . $code . \PHP_EOL . $message;
            exit;
        }
        $this->xmlObject = \simplexml_load_string($xmlString);
        return $this->xmlObject;
    }


    /**
     * Checks if /radio stream is mounted either alone or in an array with other streams, and if it is mounted
     * sets the onAir to TRUE as well as setting all stream metadata values
     * @var bool $this->onAir Will be set  TRUE if streaming
     * @var string $this->nowPlaying Artist and song information
     * @var string $this->dj Dj Name
     * @var int $this->listeners Current listener count
     * @var int $this->peakListeners Max listener count this session
     * @var string $this->description DJ defined stream description
     * @var string $this->genre DJ defined stream genre
     */
    private function setMeta()
    {
        $metaObj = self::getXml($this->metaUrl);
        if (\is_array($metaObj->mountpoint)) {
            foreach ($metaObj->mountpoint as $x) {
                if ($metaObj->mountpoint[$x]->{@attributes}->id !== '/radio') {
                    continue;
                } elseif ($metaObj->mountpoint[$x]->{@attributes}->id !== '/radio') {
                    $this->onAir = \TRUE;
                    $this->nowPlaying = $metaObj->mountpoint[$x]->playing;
                    $this->dj = $metaObj->mountpoint[$x]->name;
                    $this->currentListeners = $metaObj->mountpoint[$x]->listeners;
                    $this->peakListeners = $metaObj->mountpoint[$x]->peaklisteners;
                    $this->description = $metaObj->mountpoint[$x]->description;
                    $this->genre = $metaObj->mountpoint[$x]->genre;
                }
            }
        } elseif ($metaObj->mountpoint->{@attributes}->id === '/radio') {
            $this->onAir = \TRUE;
            $this->nowPlaying = $metaObj->mountpoint->playing;
            $this->dj = $metaObj->mountpoint->name;
            $this->currentListeners = $metaObj->mountpoint->listeners;
            $this->peakListeners = $metaObj->mountpoint->peaklisteners;
            $this->description = $metaObj->mountpoint->description;
            $this->genre = $metaObj->mountpoint->genre;
        }
    }


    /**
     * Returns the status of the /radio stream
     * @return bool TRUE if streaming, False if not
     */
    private function pollStream()
    {
        self::setMeta();
        if ($this->onAir !== \TRUE) {
            return \FALSE;
        } else {
            return \TRUE;
        }
    }


    /**
     * Trigger new poll of the stream data and return all meta to the app if available or report off state
     * @return array $this->meta Returns assoc array of all stream metadata
     */
    public function getMeta()
    {
        if (self::pollStream() === \TRUE) {
            $this->meta = [
                'status' => "ON",
                'playing' => $this->nowPlaying,
                'dj' => $this->dj,
                'listeners' => $this->currentListeners,
                'peak' => $this->peakListeners,
                'desc' => $this->description,
                'genre' => $this->genre
            ];
        } else {
            $this->meta = ['status' => "OFF"];
        }
        return $this->meta;
    }
}