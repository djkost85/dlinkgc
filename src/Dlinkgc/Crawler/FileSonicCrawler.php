<?php

namespace Dlinkgc\Crawler;

class FileSonicCrawler extends Crawler
{
    public function execute()
    {
         $dc = $this->getResponseDomCrawler();
        
         $node = $dc->filter('a.downloadLink');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}