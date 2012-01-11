<?php

namespace Dlinkgc\Crawler;

use Buzz\Message\Request;

class CommonCrawler extends Crawler
{
    public function setRequest(Request $request)
    {
        $request->setMethod(Request::METHOD_HEAD);

        $this->request = $request;

        return $this;
    }

    public function execute()
    {
        return true;
    }
}