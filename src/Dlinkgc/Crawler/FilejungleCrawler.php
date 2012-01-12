<?php

namespace Dlinkgc\Crawler;

class FilejungleCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('#file_name');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}