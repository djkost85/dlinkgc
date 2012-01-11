<?php

namespace Dlinkgc\Detector;

class UnFichierDetector implements DetectorInterface
{
    public function getName()
    {
        return '1fichier';
    }

    public function verify($url)
    {
        if (false !== strpos($url, '1fichier.com'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\UnFichierCrawler();
    }
}