<?php

namespace Dlinkgc\Detector;

class FufoxDetector implements DetectorInterface
{
    public function getName()
    {
        return 'fufox';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'fufox.net/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\FufoxCrawler();
    }
}