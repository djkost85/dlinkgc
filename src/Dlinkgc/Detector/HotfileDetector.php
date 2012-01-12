<?php

namespace Dlinkgc\Detector;

class HotfileDetector implements DetectorInterface
{
    public function getName()
    {
        return 'hotfile';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'hotfile.com/dl/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\HotfileCrawler();
    }
}