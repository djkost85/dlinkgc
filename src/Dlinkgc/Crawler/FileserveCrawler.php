<?php

namespace Dlinkgc\Crawler;

class FileserveCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('#regularBtn');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}