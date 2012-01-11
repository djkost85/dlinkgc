<?php

namespace Dlinkgc\Detector;

class UploadkingDetector implements DetectorInterface
{
    public function getName()
    {
        return 'uploadking';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'uploadking.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\UploadkingCrawler();
    }
}