<?php

namespace Dlinkgc\Crawler;

class RapidShareCrawler extends Crawler
{
    public function execute()
    {
         $dc = $this->getResponseDomCrawler();
        
         $node = $dc->filter('#download-errorbox');
        
        if (count($node) > 0)
            return false;

        return true;
    }
}