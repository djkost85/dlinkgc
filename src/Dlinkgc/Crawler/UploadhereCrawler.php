<?php

namespace Dlinkgc\Crawler;

class UploadhereCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('#countdown_txt');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}