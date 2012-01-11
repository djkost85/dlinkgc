<?php

namespace Dlinkgc\Detector;

class CommonDetector implements DetectorInterface
{
    public function getName()
    {
        return 'common';
    }

    public function verify($url)
    {
        return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\CommonCrawler();
    }
}