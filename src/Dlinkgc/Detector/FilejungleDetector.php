<?php

namespace Dlinkgc\Detector;

class FilejungleDetector implements DetectorInterface
{
    public function getName()
    {
        return 'filejungle';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'filejungle.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\FilejungleCrawler();
    }
}