<?php

namespace Dlinkgc\Crawler;

class UploadingCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('form[id="downloadform"]');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}