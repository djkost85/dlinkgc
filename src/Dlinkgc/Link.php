<?php

namespace Dlinkgc;

use Dlinkgc\Crawler\Crawler;

class Link
{
    CONST DEAD_STATUS  = 'dead';
    CONST SCHRO_STATUS = 'error';
    CONST ALIVE_STATUS = 'alive';
    CONST NO_STATUS    = 'no_response';

    protected $url;
    protected $status;
    protected $detector;
    protected $crawler;

    public function __construct($url = null, $detector = null, $status = null)
    {
        if (! is_null($url)) $this->setUrl($url);
        if (! is_null($detector)) $this->detector = $detector;
        if (! is_null($status)) $this->status = $status;
    }

    public function setUrl($url)
    {
        if (! filter_var($url, FILTER_VALIDATE_URL))
            throw new \Exception(sprintf("The URL `%s` has wrong format", $url));

        $this->url = $url;

        return $this;
    }


    public function getUrl()
    {
        return $this->url;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setDetector($detector)
    {
        $this->detector = $detector;

        return $this;
    }

    public function getDetector()
    {
        return $this->detector;
    }

    public function setCrawler(Crawler $crawler)
    {
        $this->crawler = $crawler;

        return $this;
    }

    public function getCrawler()
    {
        return $this->crawler;
    }

    public function isAlive()
    {
        return self::ALIVE_STATUS == $this->status;
    }

    public function isDead()
    {
        return self::DEAD_STATUS == $this->status;
    }

    public function isSchro()
    {
        return self::SCHRO_STATUS == $this->status;
    }

    public function hasNoStatus()
    {
        return self::NO_STATUS == $this->status;
    }
}