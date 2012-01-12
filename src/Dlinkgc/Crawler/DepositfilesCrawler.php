<?php

namespace Dlinkgc\Crawler;

class DepositfilesCrawler extends Crawler
{
    public function execute()
    {
        $dc = $this->getResponseDomCrawler();
        
        $node = $dc->filter('#free_btn');
        
        if (count($node) !== 1)
            return false;

        return true;
    }
}