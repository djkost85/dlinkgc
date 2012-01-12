<?php

namespace Dlinkgc\Crawler;

class UnFichierCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('table.ftable2');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}