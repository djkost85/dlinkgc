<?php

namespace Dlinkgc\Crawler;

use Buzz\Message\Request;
use Buzz\Message\Response;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

abstract class Crawler
{
    protected $request;
    protected $response;

    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function createDomCrawler()
    {
        return new DomCrawler();
    }

    public function getResponseDomCrawler()
    {
        $domCrawler = $this->createDomCrawler();
        $domCrawler->addContent($this->response->getContent());

        return $domCrawler;
    }

    abstract public function execute();
}