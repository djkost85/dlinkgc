<?php

namespace Dlinkgc\Crawler;

class MegaUploadCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('div.download_member_bl a.download_premium_but');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}