<?php

namespace Dlinkgc\Detector;

class MegaUploadDetector implements DetectorInterface
{
    public function getName()
    {
        return 'megaupload';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'megaupload.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\MegaUploadCrawler();
    }
}