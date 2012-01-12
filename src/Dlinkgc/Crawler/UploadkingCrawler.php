<?php

namespace Dlinkgc\Crawler;

class UploadkingCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('#countdown_div');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}