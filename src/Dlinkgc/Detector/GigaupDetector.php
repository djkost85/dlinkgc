<?php

namespace Dlinkgc\Detector;

class GigaupDetector implements DetectorInterface
{
    public function getName()
    {
        return 'gigaup';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'gigaup.fr/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\GigaupCrawler();
    }
}