<?php

namespace Dlinkgc\Detector;

class UploadingDetector implements DetectorInterface
{
    public function getName()
    {
        return 'uploading';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'uploading.com/files/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\UploadingCrawler();
    }
}