<?php

namespace Dlinkgc\Detector;

class DepositfilesDetector implements DetectorInterface
{
    public function getName()
    {
        return 'depositfiles';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'depositfiles.com/files/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\DepositfilesCrawler();
    }
}