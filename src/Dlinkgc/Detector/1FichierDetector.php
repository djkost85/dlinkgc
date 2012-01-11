<?php

namespace Dlinkgc\Detector;

class 1FichierDetector implements DetectorInterface
{
    public function getName()
    {
        return 'filesonic';
    }

    public function verify($url)
    {
        if (false !== strpos($url, 'filesonic.fr/file/'))
            return true;
    }

    public function getCrawler()
    {
        return new \Dlinkgc\Crawler\1FichierCrawler();
    }
}