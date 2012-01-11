<?php

namespace Dlinkgc\Detector;

class FileserveDetector implements DetectorInterface
{
    public function getName()
    {
        return 'fileserve';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'fileserve.com/file/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\FileserveCrawler();
    }
}