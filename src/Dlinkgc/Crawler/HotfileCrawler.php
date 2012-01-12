<?php

namespace Dlinkgc\Crawler;

class HotfileCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('form[name="f"]');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}