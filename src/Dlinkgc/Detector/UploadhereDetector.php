<?php

namespace Dlinkgc\Detector;

class UploadhereDetector implements DetectorInterface
{
    public function getName()
    {
        return 'uploadhere';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'uploadhere.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\UploadhereCrawler();
    }
}