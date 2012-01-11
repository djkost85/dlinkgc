<?php

namespace Dlinkgc\Detector;

class RapidShareDetector implements DetectorInterface
{
    public function getName()
    {
        return 'rapidshare';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'rapidshare.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\RapidShareCrawler();
    }
}