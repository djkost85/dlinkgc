<?php

namespace Dlinkgc\Detector;

class MultiuploadDetector implements DetectorInterface
{
    public function getName()
    {
        return 'multiupload';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'multiupload.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\MultiuploadCrawler();
    }
}