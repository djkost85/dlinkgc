<?php

namespace Dlinkgc\Detector;

class UptoboxDetector implements DetectorInterface
{
    public function getName()
    {
        return 'uptobox';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'uptobox.com/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\UptoboxCrawler();
    }
}