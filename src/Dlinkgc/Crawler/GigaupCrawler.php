<?php

namespace Dlinkgc\Crawler;

class GigaupCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('input[name="dl_file"]');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}