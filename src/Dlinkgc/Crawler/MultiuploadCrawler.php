<?php

namespace Dlinkgc\Crawler;

class MultiuploadCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('#uploadwindow');
        
        if (count($node) == 1)
            return false;

        return true;
    }
}